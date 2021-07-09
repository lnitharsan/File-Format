<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\File;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();

        $this->call(AttributesSeeder::class);

        File::factory()->count(10)->create();

        // Get all the attributes attaching up to 3 random attributes to each file
        $attributes = Attribute::all();

        // Populate the pivot table
        File::all()->each(function ($file) use ($attributes) {
            $file->attributes()->attach(
                $attributes->random(rand(1, 5))->pluck('id')->toArray(),
                [
                    'order' => rand(1, 5)
                ]
            );
        });

        Model::reguard();
    }
}
