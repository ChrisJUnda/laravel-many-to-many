<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Technology::truncate();

        $technologies = ['HTML', 'CSS', 'SCSS', 'Bootstrap', 'Javascript', 'AXIOS', 'VUE', 'PHP', 'MySQL', 'SQL', 'Laravel'];

        foreach ($technologies as $technology) {

            $new_technology = new Technology();

            $new_technology->title = $technology;
            $new_technology->slug = Str::of($technology)->slug();

            $new_technology->save();
        }


        Schema::enableForeignKeyConstraints();
    }
}
