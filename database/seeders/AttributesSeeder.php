<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    protected $atttibutes = [
        'Product name',
        'Vendor name',
        'Brand',
        'Price',
        'Stock'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->atttibutes as $atttibute) {
            Attribute::create([
                'name' => $atttibute
            ]);
        }
    }
}
