<?php namespace App\Transformers;

use App\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{

    protected $availableEmbeds = [
        'user'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            'id'           => (int) $comment->id,
            'content'      => $comment->content,
            'created_at'   => (String) $comment->created_at,
        ];
    }

    public function embedUser(Comment $comment)
    {
        $user = $comment->user;
        return $this->item($user, new UserTransformer);
    }
}
