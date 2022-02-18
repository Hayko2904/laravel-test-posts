<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repository\ServiceInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $postService;
    public $postModel;

    public function __construct(
        ServiceInterface $postService,
        Post $post
    )
    {
        $this->postService = $postService;
        $this->postModel = $post;
    }

    public function index()
    {
        if (auth()->user()) {
            $data = auth()->user()->is_admin
                ? $this->postService->doIndex($this->postModel)
                : $this->postService->doIndex($this->postModel, function () {
                    return auth()->user()->posts;
                });
        } else {
            $data = $this->postService->getPostsWithoutAuth($this->postModel);
        }

        return view('home', [
            'posts' => $data
        ]);
    }

    public function edit(int $id)
    {
        $post = auth()->user()->is_admin
            ? $this->postService->doGetById($id, $this->postModel)
            : $this->postService->doGetById($id, $this->postModel, auth()->user()->id);

        return view('edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, int $id)
    {
        auth()->user()->is_admin
            ? $this->postService->doUpdate($request, $id, $this->postModel)
            : $this->postService->doUpdate($request, $id, $this->postModel, null, auth()->user()->id);

        return redirect()->route('home');
    }

    public function delete(int $id)
    {
        auth()->user()->is_admin
            ? $this->postService->doDelete($id, $this->postModel)
            : $this->postService->doDelete($id, $this->postModel, auth()->user()->id);

        return redirect()->route('home');
    }
}
