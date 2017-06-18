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
      DB::table('adminusers')->insert(
        array(
            array(
              'id' 			=> '1',
              'name' 			=> 'Admin',
              'email' 		=> 'admin@admin.com',
              'password' 		=> Hash::make('admin'),
          ),
        )
      );
    }
}
