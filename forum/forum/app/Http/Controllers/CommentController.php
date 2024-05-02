<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Discussion $discussion)
    {
        return view('comments.create', compact('discussion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, Discussion $discussion)
    {
        $data = [
            'content' => $request->input('content'),
            'discussion_id' => $discussion->id,
            'user_id' => Auth::id(), 
        ];
    
        Comment::create($data);
        return redirect()->route('discussion.show', $discussion->id)->with('message', 'Comment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion, Comment $comment)
    {
        return view('comments.edit', compact('discussion', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, Discussion $discussion, Comment $comment)
    {
        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('discussion.show', $discussion->id)->with('message', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion, Comment $comment)
    {
        $comment->delete();

        return redirect()->route('discussion.show', $discussion->id)->with('message', 'Comment deleted successfully');
    }
}
