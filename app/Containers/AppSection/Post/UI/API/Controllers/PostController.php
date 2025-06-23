<?php

namespace App\Containers\AppSection\Post\UI\API\Controllers;

use App\Containers\AppSection\Post\Actions\CreatePostAction;
use App\Containers\AppSection\Post\Actions\ListPostsAction;
use App\Containers\AppSection\Post\Actions\UpdatePostAction;
use App\Containers\AppSection\Post\Actions\DeletePostAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ship\Parents\Controllers\ApiController;
use App\Containers\AppSection\Auth\Enums\Role;
use App\Containers\AppSection\Post\Models\Post;

class PostController extends ApiController
{
    public function list(Request $request, ListPostsAction $listPosts)
    {
        $user = Auth::user();
        $filters = [];

        if ($user->role === Role::EMPLOYEE->value) {
            $filters['user_id'] = $user->id;
        } elseif ($user->role === Role::MANAGER->value) {
            $filters['manager_id'] = $user->id;
        }

        if ($request->has('category_id')) {
            $filters['category_id'] = $request->input('category_id');
        }
        return $listPosts->run($filters);
    }

    public function store(Request $request, CreatePostAction $createPost)
    {
        // $this->authorize('create', Post::class);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|string',                       //в виде base64 или url
            'category_id' => 'required|exists:categories,id',
        ]);
        $data['user_id'] = Auth::id();
        $post = $createPost->run($data);
        
        return response()->json($post, 201);
    }

    public function update(Request $request, $id, UpdatePostAction $updatePost)
    {
        $post = Post::findOrFail($id);
        // $this->authorize('update', $post);

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'image' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
        ]);
        $post = $updatePost->run($id, $data);

        return response()->json($post);
    }

    public function destroy($id, DeletePostAction $deletePost)
    {
        $post = Post::findOrFail($id);
        // $this->authorize('delete', $post);

        $deletePost->run($id);

        return response()->json(['message' => 'Deleted'], 204);
    }

    public function showByCategory($categoryId, ListPostsAction $listPosts)
    {
        $user = Auth::user();
        $filters = ['category_id' => $categoryId];

        if ($user->role === Role::EMPLOYEE->value) {
            $filters['user_id'] = $user->id;
        } elseif ($user->role === Role::MANAGER->value) {
            $filters['manager_id'] = $user->id;
        }

        return $listPosts->run($filters);
    }

    public function showByEmployee($employeeId, ListPostsAction $listPosts)
    {
        $user = Auth::user();

        if (!$user->role === Role::MANAGER->value) {
            abort(403);
        }

        $filters = ['user_id' => $employeeId, 'manager_id' => $user->id];

        return $listPosts->run($filters);
    }
} 