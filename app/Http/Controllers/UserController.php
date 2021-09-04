<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $recipes = Recipe::where('user_id', $id)->orderBy('id', 'desc')->paginate(6);
        $count = Recipe::where('user_id', $id)->count();
        return view('users.show', compact('user', 'recipes', 'count'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showUserComments($id)
    {
        $user = User::findOrFail($id);
        $comments = Comment::where('user_id', $id)->paginate(6);
        $count = Comment::where('user_id', $id)->count();
        return view('comments.showUserComments', compact('user', 'comments', 'count'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // check -  user cannot access other users profile
        $this->authorize('is-user', $user);
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'avatar' => 'mimes:jpg,svg,png,jpeg'

        ], ['avatar.mimes' => 'Unsupported file. Please upload only images.']);

      $user = User::findOrFail($id);
        // handle user avatar
      $name = $user->avatar;
        if( $request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/avatars');
            $image->move($destinationPath, $name);
            if( $user->avatar ) {
                unlink(public_path('/images/avatars/'.$user->avatar)); // remove old image image
            }
        }
        // update
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $name;
        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function change_password($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('is-user', $user);

        return view('users.change-password', [
            'user'=> $user
        ]);
    }

    /**
     * @param Request $request
     * @return bool|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update_password(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        $this->authorize('is-user', $user);

        if( Hash::check($request->old_password, $user->password) ) {
            $user->update([
                'password' => bcrypt($request->new_password)
            ]);
            return redirect()->back()->with('success', 'Password is updated.');
        } else {
            return false;
        }

    }
}
