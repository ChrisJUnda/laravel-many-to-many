<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostTechnology;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PostTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();


        PostTechnology::truncate();


        for ($i = 0; $i < 10; $i++) {
            $new_post_technology = new PostTechnology();

            $new_post_technology->post_id = Post::inRandomOrder()->first()->id;
            $new_post_technology->technology_id = Technology::inRandomOrder()->first()->id;

            $new_post_technology->save();
        }
        Schema::enableForeignKeyConstraints();
    }
}
