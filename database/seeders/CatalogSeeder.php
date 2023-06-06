<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catalog;
use Illuminate\Support\Facades\DB;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('catalogs')->insert([
            [
                'name'=>'Пылесосы',
                'body' => 'Пылесосы описание'
            ],
            [
                'name'=>'Книги',
                'body' => 'Книги описание'
            ]
        ]);
    }
}
