<?php

namespace Tests\Feature;

use App\Models\BlogPosts;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Spatie\Backup\Config\Config;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Tests\TestCase;

class UpgradeCompatibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_blog_renders_and_restricted_posts_remain_private(): void
    {
        $author = User::factory()->create();
        $category = DB::table('blog_categories')->insertGetId(['name' => 'News']);
        $post = new BlogPosts;
        $post->forceFill([
            'title' => 'Upgrade test post', 'slug' => 'upgrade-test-post',
            'summary' => 'A summary', 'body' => '<h2>Test heading</h2><p>Test body</p>',
            'date' => '2026-10-10', 'user_id' => $author->id, 'categories_id' => $category,
            'published' => true, 'subscriber_only' => false,
        ])->save();
        $this->get('/')->assertOk()->assertSee($post->title);
        $this->get('/blog')->assertOk()->assertSee($post->title);
        $this->get('/blog/'.$post->slug)->assertOk()->assertSee('Test body');
        $post->forceFill(['subscriber_only' => true, 'published' => false])->save();
        $this->get('/blog/'.$post->slug)->assertForbidden();
        $this->get('/blog')->assertOk()->assertDontSee($post->title);
    }

    public function test_backup_configuration_can_be_loaded_by_the_new_package(): void
    {
        $this->assertInstanceOf(Config::class, Config::fromArray(config('backup')));
    }

    public function test_sitemap_package_renders_post_urls(): void
    {
        $xml = Sitemap::create()->add(Url::create('https://example.com/blog/test'))->render();
        $this->assertStringContainsString('https://example.com/blog/test', $xml);
    }
}
