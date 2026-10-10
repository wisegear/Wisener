<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class ImportPropBlog extends Command
{
    protected $signature = 'blog:import-prop {export : JSON export} {source : Prop directory} {--dry-run}';

    protected $description = 'Import Prop posts and images into empty blog tables; keep subscriber posts as restricted drafts.';

    public function handle(): int
    {
        $data = json_decode(file_get_contents($this->argument('export')), true, 512, JSON_THROW_ON_ERROR);
        foreach (['blog_posts', 'blog_categories', 'blog_tags', 'blog_post_tags'] as $table) {
            if (DB::table($table)->exists()) {
                throw new RuntimeException("{$table} must be empty; existing content will not be overwritten.");
            }
        }
        $files = [];
        $normalize = function (string $value) use (&$files): string {
            return preg_replace_callback('~(?:(?:https?://(?:prop\.test|www\.prop\.test))?(?:/|\.\./)*)(?:storage/)?(assets/images/uploads/[^"\'<>?#]+)~', function (array $match) use (&$files): string {
                $path = rawurldecode($match[1]);
                $files[$path] = true;

                return '/'.$path;
            }, $value);
        };
        foreach ($data['blog_posts'] as &$post) {
            $post['body'] = $normalize($post['body']);
            foreach (['images', 'gallery_images'] as $field) {
                if ($post[$field]) {
                    $images = json_decode($post[$field], true, 512, JSON_THROW_ON_ERROR);
                    array_walk_recursive($images, function (&$value) use ($normalize, $field, &$files): void {
                        if ($field === 'gallery_images') {
                            $files['assets/images/uploads/galleries/'.$value] = true;
                        } else {
                            $value = $normalize($value);
                        }
                    });
                    $post[$field] = json_encode($images, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
                }
            }
            if ($post['original_image']) {
                foreach (['', 'small_', 'medium_', 'large_'] as $prefix) {
                    $files['assets/images/uploads/'.$prefix.$post['original_image']] = true;
                }
            }
            foreach (['published', 'featured', 'subscriber_only'] as $field) {
                $post[$field] = (int) $post[$field];
            }
            if ($post['subscriber_only']) {
                $post['published'] = 0;
            }
        }
        unset($post);
        $sources = [];
        $missing = [];
        foreach (array_keys($files) as $path) {
            if (str_contains($path, '..') || ! str_starts_with($path, 'assets/images/uploads/')) {
                throw new RuntimeException('Unsafe image path.');
            }
            foreach (['storage/app/public/', 'public/'] as $base) {
                $source = rtrim($this->argument('source'), '/').'/'.$base.$path;
                if (is_file($source)) {
                    $sources[$path] = $source;
                    break;
                }
            }
            if (! isset($sources[$path])) {
                $missing[] = $path;
            }
        }
        $this->info(count($data['blog_posts']).' posts; '.count($sources).' image files; '.count($missing).' missing images.');
        foreach ($missing as $path) {
            $this->warn($path);
        }
        if ($this->option('dry-run')) {
            return self::SUCCESS;
        }
        foreach ($sources as $path => $source) {
            $target = public_path($path);
            if (is_file($target)) {
                if (hash_file('sha256', $target) !== hash_file('sha256', $source)) {
                    throw new RuntimeException("Image collision: {$path}");
                }

                continue;
            }
            if (! is_dir(dirname($target))) {
                mkdir(dirname($target), 0755, true);
            }
            if (! copy($source, $target)) {
                throw new RuntimeException("Could not copy {$path}");
            }
        }
        DB::transaction(function () use ($data): void {
            $authors = [];
            foreach ($data['authors'] as $author) {
                $existing = DB::table('users')->where('email', $author['email'])->first();
                $authors[$author['id']] = $existing?->id ?? DB::table('users')->insertGetId([
                    'name' => $author['name'], 'name_slug' => Str::slug($author['name']),
                    'email' => $author['email'], 'password' => Hash::make(Str::random(64)),
                    'lock' => true, 'created_at' => now(), 'updated_at' => now(),
                ]);
            }
            foreach (['blog_categories', 'blog_tags', 'blog_posts', 'blog_post_tags'] as $table) {
                foreach ($data[$table] as $row) {
                    if ($table === 'blog_posts') {
                        $row['user_id'] = $authors[$row['user_id']];
                    }
                    DB::table($table)->insert($row);
                }
            }
        });
        $this->info('Import complete. Subscriber posts remain restricted drafts.');

        return self::SUCCESS;
    }
}
