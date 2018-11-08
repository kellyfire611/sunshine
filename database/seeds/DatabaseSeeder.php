<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ChuDeTableSeeder::class);
        $this->call(LoaiTableSeeder::class);
        $this->call(SanphamTableSeeder::class);
    }
}
