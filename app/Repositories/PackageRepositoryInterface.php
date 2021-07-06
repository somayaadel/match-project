<?php
namespace App\Repositories;
use Illuminate\Http\Request;


interface PostRepositoryInterface
{
 /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function get($post_id);

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($post_id);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function store( Request $request);

    public function update($post_id, Request $post_data);


}
