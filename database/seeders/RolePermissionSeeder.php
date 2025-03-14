<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::updateOrCreate(['name' => 'admin']);
        $agentRole = Role::updateOrCreate(['name' => 'agent']);

        // Permissions
        // Tickets
        $readTickets = Permission::updateOrCreate(['name' => 'read_tickets']);

        // Retours
        $readProductReturn = Permission::updateOrCreate(['name' => 'read_returns']);
        $createProductReturn = Permission::updateOrCreate(['name' => 'create_returns']);
        $updateProductReturn = Permission::updateOrCreate(['name' => 'update_returns']);
        $deleteProductReturn = Permission::updateOrCreate(['name' => 'delete_returns']);
        // Rapports d'intervention
        $readReports = Permission::updateOrCreate(['name' => 'read_reports']);
        $createReports = Permission::updateOrCreate(['name' => 'create_reports']);
        $updateReports = Permission::updateOrCreate(['name' => 'update_reports']);
        $deleteReports = Permission::updateOrCreate(['name' => 'delete_reports']);

    }
}
