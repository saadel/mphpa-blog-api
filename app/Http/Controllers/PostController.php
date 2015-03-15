<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\APIController;

use Illuminate\Http\Request;
use App\Post;

use App\Transformers\PostTransformer;
use App\Transformers\CommentTransformer;

class PostController extends ApiController
{
    public function index()
    {
        $posts = Post::take(10)->get();

        return $this->respondWithCollection($posts, new PostTransformer);
    }

    public function show($id)
    {
        $post = Post::find($id);
        
        if (! $post) {
            return $this->errorNotFound('A post with this ID doesn\'t exist.');
        }

        return $this->respondWithItem($post, new PostTransformer);
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->content = $request->content;
        $post->user = User::find($request->user_id);
        $post->save();
        return response()->json([
                "msg" => "Success",
                "id" => $post->id()
            ], 200
        );
    } 

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->content = $request->content;
        $post->user = User::find($request->user_id);
        $post->save();
        return response()->json([
                "msg" => "Success",
            ], 200
        );
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json([
                "msg" => "Success",
            ], 200
        );
    }

    public function getComments($postId)
    {
        $post = Post::find($postId);

        if (! $post) {
            return $this->errorNotFound('Post not found');
        }

        return $this->respondWithCollection($post->comments, new CommentTransformer);
    }
}
