<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\APIController;

use Illuminate\Http\Request;
use App\Comment;

use App\Transformers\CommentTransformer;

class CommentController extends ApiController
{
    public function index()
    {
        $comments = Comment::take(10)->get();

        return $this->respondWithCollection($comments, new CommentTransformer);
    }

    public function show($id)
    {
        $comment = Comment::find($id);
    	
    	if (! $comment) {
            return $this->errorNotFound('A comment with this ID doesn\'t exist.');
        }

        return $this->respondWithItem($comment, new CommentTransformer);
    }
}
