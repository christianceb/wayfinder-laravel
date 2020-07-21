<?php
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seeder for events
        DB::table('events')->insert(array(
            array(
                'id' => 1,
                'title' => 'Silent Disco',
                'description' => 'Eat your heart out with this early morning Silent Disco in a Library',
                'start' => '2020-08-12 05:00:00',
                'end' => '2020-08-12 11:00:00',
                'location_id' => 40,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 2,
                'title' => 'Photography Exhibition',
                'description' => 'Our visually impaired students showcase their work!',
                'start' => '2020-07-27 13:00:00',
                'end' => '2020-08-08 17:00:00',
                'location_id' => 27,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 3,
                'title' => 'MAD',
                'description' => 'Mobile App Development Class Certificate IV in Programming Lecturer: Adrian Gould',
                'start' => '2020-08-15 09:00:00',
                'end' => '2020-08-15 12:00:00',
                'location_id' => 20,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 4,
                'title' => 'TDD',
                'description' => 'Test Driven Development Class Certificate IV in Programming Lecturer: Adrian Gould',
                'start' => '2020-08-14 13:00:00',
                'end' => '2020-08-14 15:30:00',
                'location_id' => 24,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 5,
                'title' => 'Singing Contest',
                'description' => 'TAFE has got some mad talent!',
                'start' => '2020-08-01 18:00:00',
                'end' => '2020-08-02 17:00:00',
                'location_id' => 40,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 6,
                'title' => 'DDA',
                'description' => 'Data Driven Development Class Certificate IV in Programming Lecturer: Adrian Gould',
                'start' => '2020-07-28 09:00:00',
                'end' => '2020-07-28 12:00:00',
                'location_id' => 22,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 7,
                'title' => 'OOP',
                'description' => 'Introduction to Object Oriented Programming Class Lecturer: Ivone Bennett',
                'start' => '2020-08-02 09:30:00',
                'end' => '2020-08-02 12:00:00',
                'location_id' => 26,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 8,
                'title' => 'Web Skills',
                'description' => 'Introduction to HTML and CSS Lecturer: Tony Evans',
                'start' => '2020-08-09 13:30:00',
                'end' => '2020-08-09 16:30:00',
                'location_id' => 19,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 9,
                'title' => '.NET',
                'description' => 'Introduction to .NET Lecturer: Adrian Gould',
                'start' => '2020-08-11 11:00:00',
                'end' => '2020-08-11 13:30:00',
                'location_id' => 50,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
            array(
                'id' => 10,
                'title' => 'Automate Processes',
                'description' => 'Introduction to HTML and JavaScript Lecturer: Tony Evans',
                'start' => '2020-08-21 14:00:00',
                'end' => '2020-08-21 16:00:00',
                'location_id' => 23,
                'upload_id' => null,
                'created_at' => '2020-07-21 03:35:00',
                'updated_at' => '2020-07-21 03:35:00',
            ),
        ));
    }
}
