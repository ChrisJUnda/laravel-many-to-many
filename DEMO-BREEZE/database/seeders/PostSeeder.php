<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

// 

// // laravel-framework

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 100; $i++) {

            $post = new Post();

            $post->title = $faker->sentence(3);
            $post->content = $faker->text(500);
            $post->slug = Str::of($post->title)->slug();
            // dd($post->title, $post->slug);

            $post->save();
            // $table->text('content')->nullable();
            //     $table->string('slug');
        }
    }
}
