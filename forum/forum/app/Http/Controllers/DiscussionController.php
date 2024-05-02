<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DiscussionRequest;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discussions = Discussion::where('is_approved', true)->get();

        return view('discussions.index', ['discussions' => $discussions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('discussions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscussionRequest $request)
    {

        $user = Auth::user();
        $category_id = $request->input('category');

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $user->id,
            'category_id' => $category_id,
        ];


        $pattern = '/([^\/]+)$/';

        $path = $request->file('picture')->storePublicly('public/images');

        preg_match($pattern, $path, $matches);

        $data['picture'] = $matches[1];
     
        
        $discussion = Discussion::create($data);

        return redirect()->route('discussion.index', $discussion->id)->with('message', 'Discussion successfully created! It needs to be approved before you dig into it though! :)');
    }



    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {
        $comments = $discussion->comments()->with('user')->get();

        return view('discussions.show', compact('discussion', 'comments'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion)
    {
        $categories = Category::all();
        return view('discussions.edit', compact('discussion', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscussionRequest $request, Discussion $discussion)
    {
        $category_id = $request->input('category');
    
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $category_id,
        ];
    
        if ($request->hasFile('picture')) {
            Storage::delete('public/images/' . $discussion->picture);
    
            $pattern = '/([^\/]+)$/';
            $path = $request->file('picture')->storePublicly('public/images');
            preg_match($pattern, $path, $matches);
            $data['picture'] = $matches[1];
        }
    
        $discussion->update($data);
    
        return redirect()->route('discussion.show', $discussion->id)->with('message', 'Discussion updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->comments()->delete();

        // Delete the discussion
        $discussion->delete();

        return redirect()->route('discussion.index')->with('message', 'Discussion deleted successfully');
    }


    public function approve()
    {

        $discussions = Discussion::where('is_approved', false)->get();
        return view('discussions.approve', compact('discussions'));
    }

    public function approveDiscussion(Request $request, Discussion $discussion)
    {
        $discussion->update(['is_approved' => true]);

        return redirect()->back()->with('message', 'Discussion approved successfully');
    }
}
