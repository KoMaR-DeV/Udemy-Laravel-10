<?php

namespace App\Http\Controllers;

use App\Events\RealTimeMessage;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPost;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

/**
 * Resource full controller
 */
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('posts.index', [
            'posts' => Post::withCount('usersThatLike')
                ->with('user')
                ->orderByDesc('users_that_like_count')
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:100',
            'content' => 'required|string|max:3000'
        ]);

        $post = $request->user()->posts()->create($validated);

        $message = 'New post: <a href="' . route('posts.show', $post->id) . '">' . $post->title . '</a>';

        event(new RealTimeMessage($message));
        
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, $locale = 'en'): View
    {
        App::setLocale($locale);
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Post $post): View
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:100',
            'content' => 'required|string|max:3000'
        ]);

        $post->update($validated);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $post->delete();

        return redirect(route('posts.index'));
    }

    public function user($id, $locale = 'en'): View
    {
        $user = User::find($id);

        App::setLocale($locale);
        return view('posts.index', [
            'posts' => Post::withCount('usersThatLike')
                ->with('user')
                ->where('user_id', $id)
                ->orderByDesc('users_that_like_count')
                ->paginate(10),
            'user'  => $user->name,
        ]);
    }

    public function toggleFollow(Request $request, User $user)
    {
        $loggedInUser = auth()->user();

        if ($loggedInUser->isFollowing($user)) {
            $loggedInUser->following()->detach($user);
        } else {
            $loggedInUser->following()->attach($user);
        }

        return back();
    }
}
