<?php

use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('floors')->insert([
            [
                "id" => 1,
                "name" => "L1",
                "order" => 0,
                "ne_lng" => 115.86192898,
                "ne_lat" => -31.94678410,
                "sw_lng" => 115.86062885,
                "sw_lat" => -31.94767857,
                "created_at" => "2020-10-23 03:35:08",
                "updated_at" => "2020-10-23 03:35:08",
                "upload_id" => null,
                "location_id" => 3,
            ],
            [
                "id" => 2,
                "name" => "L2",
                "order" => 1,
                "ne_lng" => 115.86192898,
                "ne_lat" => -31.94678410,
                "sw_lng" => 115.86062885,
                "sw_lat" => -31.94767857,
                "created_at" => "2020-10-23 03:35:08",
                "updated_at" => "2020-10-23 03:35:08",
                "upload_id" => null,
                "location_id" => 3,
            ],
            [
                "id" => 3,
                "name" => "L3",
                "order" => 2,
                "ne_lng" => 115.86192898,
                "ne_lat" => -31.94678410,
                "sw_lng" => 115.86062885,
                "sw_lat" => -31.94767857,
                "created_at" => "2020-10-23 03:35:08",
                "updated_at" => "2020-10-23 03:35:08",
                "upload_id" => null,
                "location_id" => 3,
            ],
            [
                "id" => 4,
                "name" => "L1",
                "order" => 0,
                "ne_lng" => 115.84298388,
                "ne_lat" => -31.93361567,
                "sw_lng" => 115.84150883,
                "sw_lat" => -31.93437152,
                "created_at" => "2020-10-24 14:35:14",
                "updated_at" => "2020-10-24 14:35:14",
                "upload_id" => null,
                "location_id" => 10,
            ],
            [
                "id" => 5,
                "name" => "L2",
                "order" => 1,
                "ne_lng" => 115.84298388,
                "ne_lat" => -31.93361567,
                "sw_lng" => 115.84150883,
                "sw_lat" => -31.93437152,
                "created_at" => "2020-10-24 14:36:06",
                "updated_at" => "2020-10-24 14:36:06",
                "upload_id" => null,
                "location_id" => 10,
            ],
            [
                "id" => 6,
                "name" => "L3",
                "order" => 2,
                "ne_lng" => 115.84298388,
                "ne_lat" => -31.93361567,
                "sw_lng" => 115.84150883,
                "sw_lat" => -31.93437152,
                "created_at" => "2020-10-24 14:36:34",
                "updated_at" => "2020-10-24 14:36:34",
                "upload_id" => null,
                "location_id" => 10,
            ],
            [
                "id" => 7,
                "name" => "L4",
                "order" => 3,
                "ne_lng" => 115.84298388,
                "ne_lat" => -31.93361567,
                "sw_lng" => 115.84150883,
                "sw_lat" => -31.93437152,
                "created_at" => "2020-10-24 15:12:00",
                "updated_at" => "2020-10-24 15:12:00",
                "upload_id" => null,
                "location_id" => 10,
            ],
        ]);
    }
}
