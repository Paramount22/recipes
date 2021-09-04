<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentUnlikeController extends Controller
{
    /**
     * CommentUnlikeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Request $request, Comment $comment)
    {
        if( $comment->unlikedBy($request->user()) ) {
            return redirect('/recipes/' . $comment->recipe->slug . '#comments')
                ->with('warning', 'You have already done this action');
        }
        $comment->unlikes()->create([
            'user_id' => $request->user()->id
        ]);
        return redirect('/recipes/' . $comment->recipe->slug . '#comments')
            ->with('success', 'Comment unliked');
    }
}
