<?php

namespace Tests\Feature\Integration\Models;

use App\Article;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function it_fetches_trending_articles()
    {
        //Given
        factory(Article::class,3)->create();
        factory(Article::class)->create(['reads'=>4]);
        $trendingArticle = factory(Article::class)->create(['reads'=>100]);

        //When
        $articles = Article::trending()->get();

        //Then
        $this->assertEquals($trendingArticle->id,$articles->first()->id);
        $this->assertCount(5,$articles);

    }
}
