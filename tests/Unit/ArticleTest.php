<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_a_category()
    {
        $article = factory('App\Article')->create();

        $this->assertInstanceOf('App\Category', $article->category);
    }

    /** @test */
    public function has_comments()
    {
        $article = factory('App\Article')->create();

        factory('App\Comment', 10)->create(['article_id' => $article->id]);

        $this->assertInstanceOf('App\Comment', $article->comments->first());

        $this->assertCount(10, $article->comments);
    }

    /** @test */
    public function has_views()
    {
        $article = factory('App\Article')->create();

        $articleView = factory('App\ArticleView')->create(['article_id' => $article->id]);

        $this->assertInstanceOf('App\ArticleView', $article->views->first());

        $this->assertCount(1, $article->views);

        $this->assertTrue($article->views->contains($articleView));
    }
}
