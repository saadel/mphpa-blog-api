<?php namespace App\Transformers;

use App\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to embed via this processor
     *
     * @var array
     */
    protected $availableEmbeds = [
        'user',
        'comments'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Post $post)
    {
        return [
            'id'           => (int) $post->id,
            'title'      => $post->title,
            'content'      => $post->content,
            'created_at'   => $post->created_at,
        ];
    }

    public function embedComments(Post $post)
    {
        $comments = $post->comments;
        return $this->collection($comments, new CommentTransformer);
    }

    public function embedUser(Post $post)
    {
        $user = $post->user;
        return $this->item($user, new UserTransformer);
    }
}
