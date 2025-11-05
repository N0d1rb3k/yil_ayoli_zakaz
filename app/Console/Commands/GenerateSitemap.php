<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post; // change to your model

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Add home page
        $sitemap->add(Url::create('/')->setPriority(1.0));

        // Add dynamic pages (example: blog posts)
        foreach (Post::all() as $post) {
            $sitemap->add(
                Url::create("/post/{$post->slug}")
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.8)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generated successfully!');
        return Command::SUCCESS;
    }
}
