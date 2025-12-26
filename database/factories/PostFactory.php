<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(4, 8));
        $body = $this->generateBody();

        // Random status: mostly published, some drafts
        $status = $this->faker->randomElement(['published', 'published', 'published', 'draft']);

        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(rand(2, 3)),
            'body' => $body,
            'status' => $status,
            'published_at' => $status === 'published'
                ? $this->faker->dateTimeBetween('-6 months', 'now')
                : null,
        ];
    }

    /**
     * Generate realistic blog post body content
     */
    private function generateBody(): string
    {
        $paragraphs = [];
        $paragraphCount = rand(5, 12);

        for ($i = 0; $i < $paragraphCount; $i++) {
            $sentenceCount = rand(4, 8);
            $paragraph = '';

            for ($j = 0; $j < $sentenceCount; $j++) {
                $paragraph .= $this->faker->sentence(rand(8, 20)) . ' ';
            }

            $paragraphs[] = '<p>' . trim($paragraph) . '</p>';

            // Occasionally add a heading
            if ($i > 0 && $i < $paragraphCount - 1 && rand(0, 3) === 0) {
                $paragraphs[] = '<h2>' . $this->faker->sentence(rand(3, 6)) . '</h2>';
            }

            // Occasionally add a list
            if (rand(0, 5) === 0) {
                $listItems = [];
                for ($k = 0; $k < rand(3, 5); $k++) {
                    $listItems[] = '<li>' . $this->faker->sentence(rand(5, 10)) . '</li>';
                }
                $paragraphs[] = '<ul>' . implode('', $listItems) . '</ul>';
            }
        }

        return implode("\n\n", $paragraphs);
    }

    /**
     * Indicate that the post is published.
     */
    public function published(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /**
     * Indicate that the post is a draft.
     */
    public function draft(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }

    /**
     * Indicate that the post was published recently.
     */
    public function recent(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ]);
    }
}
