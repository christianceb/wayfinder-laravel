<?php

use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// seeder for the locations
        DB::table('locations')->insert(array(
            array(
                'id' => 1,
                'name' => 'Northbridge',
                'type' => 0,
                'parent_id' => 0,
                'upload_id' => null,
                'address' => 'Building 1, 25, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => 'address.2121005564981030',
                'mp_lat' => '-31.94802897',
                'mp_lng' => '115.86094053',
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 2,
                'name' => 'Leederville',
                'type' => 0,
                'parent_id' => 0,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => 'address.3814715266816138',
                'mp_lat' => '-31.93396092',
                'mp_lng' => '115.84257784',
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 3,
                'name' => 'Building 2',
                'type' => 1,
                'parent_id' => 1,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => 'address.2121005564981030',
                'mp_lat' => '-31.94719248',
                'mp_lng' => '115.86127470',
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 6,
                'name' => 'Building 6',
                'type' => 1,
                'parent_id' => 1,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => 'address.2121005564981030',
                'mp_lat' => '-31.94845932',
                'mp_lng' => '115.86247545',
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 10,
                'name' => 'A Block',
                'type' => 1,
                'parent_id' => 2,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => 'address.3814715266816138',
                'mp_lat' => '-31.93379349',
                'mp_lng' => '115.84181612',
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 14,
                'name' => 'B Block',
                'type' => 1,
                'parent_id' => 2,
                'upload_id' => null,
                'address' => 'B Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => 'address.3814715266816138',
                'mp_lat' => '-31.93418229',
                'mp_lng' => '115.84334853',
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 16,
                'name' => '1-31-1',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 17,
                'name' => '1-13',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 18,
                'name' => '1-07',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 19,
                'name' => '2-59',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 20,
                'name' => '2-60',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 21,
                'name' => '2-61',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 22,
                'name' => '3-01',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 23,
                'name' => '3-04',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 24,
                'name' => '3-06',
                'type' => 2,
                'parent_id' => 3,
                'upload_id' => null,
                'address' => 'Building 2, 30, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 25,
                'name' => 'B116',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 26,
                'name' => 'B133',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 27,
                'name' => 'B110 Photography Studio',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 28,
                'name' => 'B259',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 29,
                'name' => 'B262',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 30,
                'name' => 'B263',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 31,
                'name' => 'B301',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 32,
                'name' => 'B305',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 33,
                'name' => 'B343',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 34,
                'name' => 'B404',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 35,
                'name' => 'B405',
                'type' => 2,
                'parent_id' => 6,
                'upload_id' => null,
                'address' => 'Building 6, 19, Aberdeen Street, Northbridge, Perth, Western Australia, 6000, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 36,
                'name' => 'Campus Cafe',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 37,
                'name' => 'A108',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 38,
                'name' => 'A140',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 39,
                'name' => 'A250 Lecture',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 40,
                'name' => 'A240 Library',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 41,
                'name' => 'A229',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 42,
                'name' => 'A319',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 43,
                'name' => 'A333',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 44,
                'name' => 'A346',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 45,
                'name' => 'A402',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 46,
                'name' => 'A413',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 47,
                'name' => 'A418',
                'type' => 2,
                'parent_id' => 10,
                'upload_id' => null,
                'address' => 'A Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 48,
                'name' => 'B102',
                'type' => 2,
                'parent_id' => 14,
                'upload_id' => null,
                'address' => 'B Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 49,
                'name' => 'B103',
                'type' => 2,
                'parent_id' => 14,
                'upload_id' => null,
                'address' => 'B Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 50,
                'name' => 'B107',
                'type' => 2,
                'parent_id' => 14,
                'upload_id' => null,
                'address' => 'B Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 51,
                'name' => 'B220',
                'type' => 2,
                'parent_id' => 14,
                'upload_id' => null,
                'address' => 'B Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 52,
                'name' => 'B221',
                'type' => 2,
                'parent_id' => 14,
                'upload_id' => null,
                'address' => 'B Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
            array(
                'id' => 53,
                'name' => 'B227',
                'type' => 2,
                'parent_id' => 14,
                'upload_id' => null,
                'address' => 'B Block, Richmond Street, Leederville, Perth, Western Australia, 6007, Australia',
                'mp_id' => null,
                'mp_lat' => null,
                'mp_lng' => null,
                'created_at' => '2020-07-21 02:35:00',
                'updated_at' => '2020-07-21 02:35:00',
            ),
        ));
	}
}
