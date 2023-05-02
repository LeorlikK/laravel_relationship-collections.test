<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ManyToManyFirst;
use App\Models\ManyToManySecond;
use App\Models\OneToManyFirst;
use App\Models\OneToManySecond;
use App\Models\OneToOneFirst;
use App\Models\OneToOneSecond;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $first = OneToOneFirst::factory(10)->create();
//        $second = OneToOneSecond::factory(10)->create();
//
//        $second = OneToManyFirst::factory(10)->create();
//        $first = OneToManySecond::factory(10)->create();

        $first = ManyToManyFirst::factory(10)->create();
        $second = ManyToManySecond::factory(10)->create();

        $first->each(function ($item)use($second){
            $item->second()->attach($second->random(3));
        });
    }
}
