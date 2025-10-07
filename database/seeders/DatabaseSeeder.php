<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   

public function run(): void
{
    // cria 5 usuários
    \App\Models\User::factory(5)
        ->hasPosts(2) // cada user tem 2 posts
        ->create()
        ->each(function ($user) {
            // cada post desse user recebe comentários de outros users
            $user->posts->each(function ($post) {
                \App\Models\Comment::factory(3)->create([
                    'post_id' => $post->id,
                    'user_id' => \App\Models\User::inRandomOrder()->first()->id,
                ]);
            });
        });
}


  
}

