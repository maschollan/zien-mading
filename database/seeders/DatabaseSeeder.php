<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserProfile::factory(3)->create();
        \App\Models\Mading::factory(10)->create();

        \App\Models\Tag::create([
            'nama' => 'Makanan',
            'slug' => 'makanan',
        ]);

        \App\Models\Tag::create([
            'nama' => 'Hobi',
            'slug' => 'hobi',
        ]);

        \App\Models\Tag::create([
            'nama' => 'Pekerjaan',
            'slug' => 'pekerjaan',
        ]);

        \App\Models\Tag::create([
            'nama' => 'Kuliner',
            'slug' => 'kuliner',
        ]);

        \App\Models\Tag::create([
            'nama' => 'Pariwisata',
            'slug' => 'pariwisata',
        ]);

        \App\Models\Tag::create([
            'nama' => 'Olahraga',
            'slug' => 'olahraga',
        ]);

        \App\Models\Tag::create([
            'nama' => 'Religi',
            'slug' => 'religi',
        ]);

        \App\Models\Tag::create([
            'nama' => 'Lain-lain',
            'slug' => 'lain-lain',
        ]);
    }
}
