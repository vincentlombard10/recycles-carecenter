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
        $superAdminRole = Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web',
            'public_name' => 'Administrateur Root',
        ]);
        $adminRole = Role::updateOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
            'public_name' => 'Administrator'
        ]);
        $agentRole = Role::updateOrCreate([
            'name' => 'agent',
            'guard_name' => 'web',
            'public_name' => 'Agent'
        ]);
        $qualityRole = Role::updateOrCreate([
            'name' => 'quality',
            'guard_name' => 'web',
            'public_name' => 'Qualité'
        ]);
        $technicianRole = Role::updateOrCreate([
            'name' => 'technician',
            'guard_name' => 'web',
            'public_name' => 'Technicien'
        ]);

        $rolesPermission = Permission::updateOrCreate(['name' => 'roles']);
        $readRoles = Permission::updateOrCreate(['name' => 'roles.read']);
        $createRoles = Permission::updateOrCreate(['name' => 'roles.create']);
        $updateRoles = Permission::updateOrCreate(['name' => 'roles.update']);
        $deleteRoles = Permission::updateOrCreate(['name' => 'roles.delete']);
        $rolesPermission->syncPermissions([$createRoles, $readRoles, $updateRoles, $deleteRoles]);

        $permissionsPermission = Permission::updateOrCreate(['name' => 'permissions']);
        $readPermissions = Permission::updateOrCreate(['name' => 'permissions.read']);
        $createPermissions = Permission::updateOrCreate(['name' => 'permissions.create']);
        $updatePermissions = Permission::updateOrCreate(['name' => 'permissions.update']);
        $deletePermissions = Permission::updateOrCreate(['name' => 'permissions.delete']);
        $permissionsPermission->syncPermissions([$readPermissions, $createPermissions, $updatePermissions, $deletePermissions]);

        $usersPermission = Permission::updateOrCreate(['name' => 'users']);
        $readUsers = Permission::updateOrCreate(['name' => 'users.read']);
        $createUsers = Permission::updateOrCreate(['name' => 'users.create']);
        $updateUsers = Permission::updateOrCreate(['name' => 'users.update']);
        $deleteUsers = Permission::updateOrCreate(['name' => 'users.delete']);
        $usersPermission->syncPermissions([$readUsers, $createUsers, $updateUsers, $deleteUsers]);

        $returnsPermission = Permission::updateOrCreate(['name' => 'returns']);
        $readReturns = Permission::updateOrCreate(['name' => 'returns.read']);
        $createReturns = Permission::updateOrCreate(['name' => 'returns.create']);
        $updateReturns = Permission::updateOrCreate(['name' => 'returns.update']);
        $deleteReturns = Permission::updateOrCreate(['name' => 'returns.delete']);
        $returnsPermission->syncPermissions([$readReturns, $createReturns, $updateReturns, $deleteReturns]);

        $reportsPermission = Permission::updateOrCreate(['name' => 'reports']);
        $readReports = Permission::updateOrCreate(['name' => 'reports.read']);
        $createReports = Permission::updateOrCreate(['name' => 'reports.create']);
        $updateReports = Permission::updateOrCreate(['name' => 'reports.update']);
        $deleteReports = Permission::updateOrCreate(['name' => 'reports.delete']);
        $reportsPermission->syncPermissions([$readReports, $createReports, $updateReports, $deleteReports]);

        $contactsPermission = Permission::updateOrCreate(['name' => 'contacts']);
        $readContacts = Permission::updateOrCreate(['name' => 'contacts.read']);
        $createContacts = Permission::updateOrCreate(['name' => 'contacts.create']);
        $updateContacts = Permission::updateOrCreate(['name' => 'contacts.update']);
        $deleteContacts = Permission::updateOrCreate(['name' => 'contacts.delete']);
        $contactsPermission->syncPermissions([$readContacts, $createContacts, $updateContacts, $deleteContacts]);

        $brandsPermission = Permission::updateOrCreate(['name' => 'brands']);
        $readBrands = Permission::updateOrCreate(['name' => 'brands.read']);
        $createBrands = Permission::updateOrCreate(['name' => 'brands.create']);
        $updateBrands = Permission::updateOrCreate(['name' => 'brands.update']);
        $deleteBrands = Permission::updateOrCreate(['name' => 'brands.delete']);
        $brandsPermission->syncPermissions([$readBrands, $createBrands, $updateBrands, $deleteBrands]);

        $groupsPermission = Permission::updateOrCreate(['name' => 'groups']);
        $readGroups = Permission::updateOrCreate(['name' => 'groups.read']);
        $createGroups = Permission::updateOrCreate(['name' => 'groups.create']);
        $updateGroups = Permission::updateOrCreate(['name' => 'groups.update']);
        $deleteGroups = Permission::updateOrCreate(['name' => 'groups.delete']);
        $groupsPermission->syncPermissions([$readGroups, $createGroups, $updateGroups, $deleteGroups]);

        $serialsPermission = Permission::updateOrCreate(['name' => 'serials']);
        $readSerials = Permission::updateOrCreate(['name' => 'serials.read']);
        $createSerials = Permission::updateOrCreate(['name' => 'serials.create']);
        $updateSerials = Permission::updateOrCreate(['name' => 'serials.update']);
        $deleteSerials = Permission::updateOrCreate(['name' => 'serials.delete']);
        $serialsPermission->syncPermissions([$readSerials, $createSerials, $updateSerials, $deleteSerials]);

        $itemsPermission = Permission::updateOrCreate(['name' => 'items']);
        $readItems = Permission::updateOrCreate(['name' => 'items.read']);
        $createItems = Permission::updateOrCreate(['name' => 'items.create']);
        $updateItems = Permission::updateOrCreate(['name' => 'items.update']);
        $deleteItems = Permission::updateOrCreate(['name' => 'items.delete']);
        $itemsPermission->syncPermissions([$readItems, $createItems, $updateItems, $deleteItems]);

        $ticketsPermission = Permission::updateOrCreate(['name' => 'tickets']);
        $readTickets = Permission::updateOrCreate(['name' => 'tickets.read']);
        $createTickets = Permission::updateOrCreate(['name' => 'tickets.create']);
        $updateTickets = Permission::updateOrCreate(['name' => 'tickets.update']);
        $deleteTickets = Permission::updateOrCreate(['name' => 'tickets.delete']);
        $ticketsPermission->syncPermissions([$readTickets, $createTickets, $updateTickets, $deleteTickets]);

        $adminRole->syncPermissions([
            $readRoles, $createRoles, $updateRoles, $deleteRoles,
            $readPermissions, $createPermissions, $updatePermissions, $deletePermissions,
            $readUsers, $createUsers, $updateUsers, $deleteUsers,
            $readReturns, $createReturns, $updateReturns, $deleteReturns,
            $readReports, $createReports, $updateReports, $deleteReports,
            $readContacts, $createContacts, $updateContacts, $deleteContacts,
            $readBrands, $createBrands, $updateBrands, $deleteBrands,
            $readGroups, $createGroups, $updateGroups, $deleteGroups,
            $readSerials, $createSerials, $updateSerials, $deleteSerials,
            $readItems, $createItems, $updateItems, $deleteItems,
            $readTickets, $createTickets, $updateTickets, $deleteTickets,
        ]);

        $agentRole->syncPermissions([
            $readRoles, $createRoles, $updateRoles, $deleteRoles,
            $readPermissions, $createPermissions, $updatePermissions, $deletePermissions,
            $readUsers, $createUsers, $updateUsers, $deleteUsers,
            $readReturns, $createReturns, $updateReturns, $deleteReturns,
            $readReports, $createReports, $updateReports, $deleteReports,
            $readContacts, $createContacts, $updateContacts, $deleteContacts,
            $readBrands, $createBrands, $updateBrands, $deleteBrands,
            $readGroups, $createGroups, $updateGroups, $deleteGroups,
            $readSerials, $createSerials, $updateSerials, $deleteSerials,
            $readItems, $createItems, $updateItems, $deleteItems,
            $readTickets, $createTickets, $updateTickets, $deleteTickets,
        ]);

        $technicianRole->syncPermissions([
            $readRoles, $createRoles, $updateRoles, $deleteRoles,
            $readPermissions, $createPermissions, $updatePermissions, $deletePermissions,
            $readUsers, $createUsers, $updateUsers, $deleteUsers,
            $readReturns, $createReturns, $updateReturns, $deleteReturns,
            $readReports, $createReports, $updateReports, $deleteReports,
            $readContacts, $createContacts, $updateContacts, $deleteContacts,
            $readBrands, $createBrands, $updateBrands, $deleteBrands,
            $readGroups, $createGroups, $updateGroups, $deleteGroups,
            $readSerials, $createSerials, $updateSerials, $deleteSerials,
            $readItems, $createItems, $updateItems, $deleteItems,
            $readTickets, $createTickets, $updateTickets, $deleteTickets,
        ]);

        $qualityRole->syncPermissions([
            $readRoles, $createRoles, $updateRoles, $deleteRoles,
            $readPermissions, $createPermissions, $updatePermissions, $deletePermissions,
            $readUsers, $createUsers, $updateUsers, $deleteUsers,
            $readReturns, $createReturns, $updateReturns, $deleteReturns,
            $readReports, $createReports, $updateReports, $deleteReports,
            $readContacts, $createContacts, $updateContacts, $deleteContacts,
            $readBrands, $createBrands, $updateBrands, $deleteBrands,
            $readGroups, $createGroups, $updateGroups, $deleteGroups,
            $readSerials, $createSerials, $updateSerials, $deleteSerials,
            $readItems, $createItems, $updateItems, $deleteItems,
            $readTickets, $createTickets, $updateTickets, $deleteTickets,
        ]);
    }
}
