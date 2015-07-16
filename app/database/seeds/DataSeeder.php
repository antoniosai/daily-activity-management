<?php

class DataSeeder extends Seeder {

	public function run()
	{
		DB::table('lbstats')->delete();
		DB::table('logbooks')->delete();
		DB::table('reports')->delete();
		DB::table('priorities')->delete();

		$priorities = [
		['id' => 1, 'description' => 'Normal'],
		['id' => 2, 'description' => 'Penting'],
		['id' => 3, 'description' => 'Sangat Penting']
		];

		$lbstats = [
		['id' => 1, 'description' => 'Normal'],
		['id' => 2, 'description' => 'Penting'],
		['id' => 3, 'description' => 'Sangat Penting']
		];

		$lbstats_id = mt_rand(1,3);
		$priorities_id = mt_rand(1,3);
		$room_temp = mt_rand(35,42);

		for( $i = 1 ; $i <= 20 ; $i++ )
		{
			$logbook = new Logbook;
			$logbook->user_id = 1;
			$logbook->title = "Logbook ke-$i";
			$logbook->description = "Deskripsi Logbook ke-$i";
			$logbook->lbstats_id = $lbstats_id;
			$logbook->priorities_id = $priorities_id;
			$logbook->save();

			$report = new Report;
			$report->user_id = 1;
			$report->server = "Aman";
			$report->room_temp = $room_temp;
			$report->save();
		}
	}
}