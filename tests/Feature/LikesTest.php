<?php

namespace Tests\Feature;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function a_user_can_like_a_post()
    {

        //Given I Have post
        $post = factory(Post::class)->create();
        //I have user
        $user = factory(User::class)->create();
        // when user likes post

        $post->like($user->id);


        // then should post be liked & saved in database
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertTrue($post->isLiked($user->id));
    }

    /** @test */
    function a_user_can_unlike_a_post()
    {
        //Given I Have post
        $post = factory(Post::class)->create();
        //I have user
        $user = factory(User::class)->create();
        // when user likes post

        $post->like($user->id);
        $post->unLike($user->id);

        // then should post be liked & saved in database
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);


        $this->assertFalse($post->isLiked($user->id));
    }


    /** @test */
    function a_user_can_toggle_like_a_post()
    {

        //Given I Have post
        $post = factory(Post::class)->create();
        //I have user
        $user = factory(User::class)->create();
        // when user likes post

        $post->toogle($user->id);
        $this->assertTrue($post->isLiked($user->id));

        $post->toogle($user->id);
        $this->assertFalse($post->isLiked($user->id));
    }

    /** @test */
    function a_post_can_show_likes_count()
    {

        //Given I Have post
        $post = factory(Post::class)->create();
        //I have user
        $user = factory(User::class)->create();
        // when user likes post

        $post->like($user->id);

        $this->assertEquals(1,$post->likeCount);

    }




}
