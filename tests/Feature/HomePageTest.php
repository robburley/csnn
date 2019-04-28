<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function only_show_published_articles()
    {
        $article = factory('App\Article')->create(['published_at' => null]);

        $this->get('/')
            ->assertDontSee($article->title);
    }

    /** @test */
    public function see_articles()
    {
        $articles = factory('App\Article', 3)
            ->create()
            ->sortByDesc('published_at');

        $article = factory('App\Article')->create();
        factory('App\ArticleView')->create(['article_id' => $article->id]);

        $this->get('/')
            ->assertSeeInOrder($articles->pluck('title')->toArray());
    }

    /** @test */
    public function see_most_popular_article()
    {
        $articles = factory('App\Article', 3)->create()->sortByDesc('published_at');
        $article = factory('App\Article')->create();
        factory('App\ArticleView')->create(['article_id' => $article->id]);

        $this->get('/')
            ->assertSee($article->title)
            ->assertSeeInOrder($articles->pluck('title')->toArray());
    }

    /** @test */
    public function see_categories()
    {
        $categories = factory('App\Category', 5)->create()
            ->sortBy('name')
            ->map(function ($category) {
                return ucwords($category->name);
            });

        $this->get('/')
            ->assertSeeInOrder($categories->toArray());
    }
}
