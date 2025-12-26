<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tags = [
            'Laravel',
            'PHP',
            'JavaScript',
            'React',
            'Vue.js',
            'Tailwind CSS',
            'AI & ML',
            'DevOps',
            'Mobile Development',
            'Web Design',
            'UX/UI',
            'SEO',
            'Content Marketing',
            'Social Media',
            'E-commerce',
            'Startups',
            'Remote Work',
            'Freelancing',
            'Career Tips',
            'Time Management',
            'Mental Health',
            'Fitness',
            'Nutrition',
            'Travel Tips',
            'Budget Travel',
            'Photography Tips',
            'Recipe Ideas',
            'Investment',
            'Cryptocurrency',
            'Personal Finance',
        ];

        $name = $this->faker->unique()->randomElement($tags);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
