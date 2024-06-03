<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_menus = array(
            array('id' => '1', 'name' => 'Navigation Menu', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '3', 'name' => 'Footer Menu One', 'created_at' => '2024-06-02 20:06:33', 'updated_at' => '2024-06-02 20:06:33'),
            array('id' => '4', 'name' => 'Footer Menu Two', 'created_at' => '2024-06-02 20:06:51', 'updated_at' => '2024-06-02 20:06:51'),
            array('id' => '5', 'name' => 'Footer Menu Three', 'created_at' => '2024-06-02 20:07:03', 'updated_at' => '2024-06-02 20:07:03'),
            array('id' => '6', 'name' => 'Footer Menu Four', 'created_at' => '2024-06-02 20:07:12', 'updated_at' => '2024-06-02 20:07:12')
        );

        \DB::table('admin_menus')->insert($admin_menus);
    }
}
