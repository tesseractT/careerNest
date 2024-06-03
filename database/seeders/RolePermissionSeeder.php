<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = array(
            array('id' => '1', 'name' => 'dashboard analytics', 'group' => 'Dashboard', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:44:59', 'updated_at' => '2024-06-03 14:44:59'),
            array('id' => '2', 'name' => 'dashboard pending posts', 'group' => 'Dashboard', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:45:22', 'updated_at' => '2024-06-03 14:45:22'),
            array('id' => '3', 'name' => 'orders index', 'group' => 'Order', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:47:36', 'updated_at' => '2024-06-03 14:47:36'),
            array('id' => '4', 'name' => 'job category create', 'group' => 'Job Category', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:48:26', 'updated_at' => '2024-06-03 14:48:26'),
            array('id' => '5', 'name' => 'job category update', 'group' => 'Job Category', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:48:39', 'updated_at' => '2024-06-03 14:48:39'),
            array('id' => '6', 'name' => 'job category delete', 'group' => 'Job Category', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:48:45', 'updated_at' => '2024-06-03 14:48:45'),
            array('id' => '7', 'name' => 'job create', 'group' => 'Job', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:49:54', 'updated_at' => '2024-06-03 14:49:54'),
            array('id' => '8', 'name' => 'job update', 'group' => 'Job', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:50:03', 'updated_at' => '2024-06-03 14:50:03'),
            array('id' => '9', 'name' => 'job delete', 'group' => 'Job', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:50:09', 'updated_at' => '2024-06-03 14:50:09'),
            array('id' => '10', 'name' => 'job role', 'group' => 'Job Role', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:51:09', 'updated_at' => '2024-06-03 14:51:09'),
            array('id' => '11', 'name' => 'job attributes', 'group' => 'Job Attributes', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:59:07', 'updated_at' => '2024-06-03 14:59:07'),
            array('id' => '12', 'name' => 'job locations', 'group' => 'Job Locations', 'guard_name' => 'admin', 'created_at' => '2024-06-03 14:59:38', 'updated_at' => '2024-06-03 14:59:38'),
            array('id' => '13', 'name' => 'sections', 'group' => 'Site Sections', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:00:08', 'updated_at' => '2024-06-03 15:00:08'),
            array('id' => '14', 'name' => 'site pages', 'group' => 'Site Pages', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:00:40', 'updated_at' => '2024-06-03 15:00:40'),
            array('id' => '15', 'name' => 'site footer', 'group' => 'Site Footer', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:01:07', 'updated_at' => '2024-06-03 15:01:07'),
            array('id' => '16', 'name' => 'blogs', 'group' => 'Blogs', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:01:34', 'updated_at' => '2024-06-03 15:01:34'),
            array('id' => '17', 'name' => 'price plan', 'group' => 'Price Plan', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:02:02', 'updated_at' => '2024-06-03 15:02:02'),
            array('id' => '18', 'name' => 'newsletter', 'group' => 'Newsletter', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:02:36', 'updated_at' => '2024-06-03 15:02:36'),
            array('id' => '19', 'name' => 'menu builder', 'group' => 'Menu Builder', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:03:11', 'updated_at' => '2024-06-03 15:03:11'),
            array('id' => '20', 'name' => 'access management', 'group' => 'Access Management', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:06:16', 'updated_at' => '2024-06-03 15:06:16'),
            array('id' => '21', 'name' => 'payment settings', 'group' => 'Payment Settings', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:06:48', 'updated_at' => '2024-06-03 15:06:48'),
            array('id' => '22', 'name' => 'site settings', 'group' => 'Site Settings', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:06:55', 'updated_at' => '2024-06-03 15:06:55'),
            array('id' => '23', 'name' => 'database clear', 'group' => 'DB Clear', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:07:14', 'updated_at' => '2024-06-03 15:07:14')
        );

        \DB::table('permissions')->insert($permissions);

        $roles = array(
            array('id' => '1', 'name' => 'Super Admin', 'guard_name' => 'admin', 'created_at' => '2024-06-03 15:54:14', 'updated_at' => '2024-06-03 15:54:14')
        );

        \DB::table('roles')->insert($roles);

        $role_has_permissions = array(
            array('permission_id' => '1', 'role_id' => '1'),
            array('permission_id' => '2', 'role_id' => '1'),
            array('permission_id' => '3', 'role_id' => '1'),
            array('permission_id' => '4', 'role_id' => '1'),
            array('permission_id' => '5', 'role_id' => '1'),
            array('permission_id' => '6', 'role_id' => '1'),
            array('permission_id' => '7', 'role_id' => '1'),
            array('permission_id' => '8', 'role_id' => '1'),
            array('permission_id' => '9', 'role_id' => '1'),
            array('permission_id' => '10', 'role_id' => '1'),
            array('permission_id' => '11', 'role_id' => '1'),
            array('permission_id' => '12', 'role_id' => '1'),
            array('permission_id' => '13', 'role_id' => '1'),
            array('permission_id' => '14', 'role_id' => '1'),
            array('permission_id' => '15', 'role_id' => '1'),
            array('permission_id' => '16', 'role_id' => '1'),
            array('permission_id' => '17', 'role_id' => '1'),
            array('permission_id' => '18', 'role_id' => '1'),
            array('permission_id' => '19', 'role_id' => '1'),
            array('permission_id' => '20', 'role_id' => '1'),
            array('permission_id' => '21', 'role_id' => '1'),
            array('permission_id' => '22', 'role_id' => '1'),
            array('permission_id' => '23', 'role_id' => '1')
        );

        \DB::table('role_has_permissions')->insert($role_has_permissions);
    }
}
