<?php 

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    User::truncate();
    
    User::create([
      'username' => "cisolarix",
      'email' => 'cisolarix@gmail.com',
      'password' => '1234'
    ]);

    User::create([
      'username' => "doudou",
      'email' => 'doudou@gmail.com',
      'password' => '1234'
    ]);
  }
}