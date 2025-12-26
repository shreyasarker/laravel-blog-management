<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create categories (10-15 categories)
        $this->command->info('Creating categories...');
        $categories = Category::factory(12)->create();
        $this->command->info('✓ Created ' . $categories->count() . ' categories');

        // Create tags (20-30 tags)
        $this->command->info('Creating tags...');
        $tags = Tag::factory(25)->create();
        $this->command->info('✓ Created ' . $tags->count() . ' tags');

        // Create posts (50 posts)
        $this->command->info('Creating posts...');

        Post::factory(50)
            ->create()
            ->each(function ($post) use ($tags) {
                // Attach 2-5 random tags to each post
                $randomTags = $tags->random(rand(2, 5));
                $post->tags()->attach($randomTags->pluck('id'));
            });

        $this->command->info('✓ Created 50 posts with tags');
        $this->command->newLine();
        $this->command->info('Database seeding completed successfully! 🎉');
    }
}
