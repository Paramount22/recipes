<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Comment $comment
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Comment $comment, Request $request)
    {
        if (  $comment->likedBy($request->user()) ) {
            return redirect('/recipes/' . $comment->recipe->slug . '#comment-'.$comment->id)
                ->with('warning', 'You have already done this action');
        }

        $comment->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return redirect('/recipes/' . $comment->recipe->slug . '#comment-'.$comment->id)
            ->with('success', 'Comment liked');
    }
}
