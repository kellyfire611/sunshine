<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ChuDeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('vi_VN'); //zone
        
        $now = new Carbon('2018-11-01', 'Asia/Ho_Chi_Minh'); //GMT+7 UTC
        
		$list = [];
		for($i = 1; $i <= 100; $i++) {
			$created = $now->copy()->addSeconds($faker->numberBetween(1, 259200));
			$updated = $created->copy()->addSeconds($faker->numberBetween(300, 172800));
		
			array_push($list, [
					'cd_taoMoi'			=> $created,
					'cd_capNhat'		=> $updated,
					'cd_ten'			=> $faker->text(50),
					'cd_trangThai'		=> 2
				]);
			$now = $updated->copy();
		}
		
		DB::table('cusc_chude')->insert($list);
    }
}
