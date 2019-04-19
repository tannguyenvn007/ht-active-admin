<?php
use App\CategoryService;
use Illuminate\Database\Seeder;

class CategoryServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CategoryService::class, 3)->create();
    }
}
