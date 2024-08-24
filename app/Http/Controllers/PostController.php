<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    use AuthorizesRequests;

    private $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }

    /**
     * Display a listing of the posts, with optional search filtering.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $posts = Post::with([
            'categories',
            'user',
            'comments.user',
        ])
            ->when($search, function ($query, $search) {
                return $query->where('title', 'ILIKE', "%{$search}%")
                    ->orWhere('body_content', 'ILIKE', "%{$search}%");
            })
            ->latest('updated_at')
            ->latest('created_at')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return View
     */
    public function create(): View
    {
        return view('posts.create', ['categories' => $this->categories]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param StorePostRequest $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        Post::create([
            'title' => strip_tags($request->title),
            'body_content' => strip_tags($request->body_content),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        $post->load(['categories', 'user', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        $this->authorize('update', $post);
        return view('posts.edit', [
            'post' => $post,
            'categories' => $this->categories
        ]);
    }

    /**
     * Update the specified post in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $post->update([
            'title' => strip_tags($request->title),
            'body_content' => strip_tags($request->body_content),
        ]);

        $post->categories()->sync($request->input('categories', []));

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}