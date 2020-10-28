<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function there_is_a_post_model()
    {
        Post::factory()->create();
        $post = Post::first();
        $this->assertNotNull($post->id);
    }

    /** @test */
    public function posts_can_be_deleted_recursively()
    {
        $parent = Post::factory()->create();
        $child = Post::factory()->create(['post_id' => $parent->id]);
        $grandChild = Post::factory()->create(['post_id' => $child->id]);
        $parent->deleteRecursively();

        $this->assertDatabaseMissing('posts',['id' => $parent->id]);
        $this->assertDatabaseMissing('posts',['id' => $child->id]);
        $this->assertDatabaseMissing('posts',['id' => $grandChild->id]);


    }


}
