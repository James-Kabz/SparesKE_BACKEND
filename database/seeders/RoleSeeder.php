<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use RbacAuth\Models\Permission;
use RbacAuth\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        $roles = [
            [
                'name' => 'super-admin',
            ],
            [
                'name' => 'vendor',
            ],
            [
                'name' => 'user',
            ],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );
        }

        // Get all roles
        $superAdmin = Role::where('name', 'super-admin')->first();
        $vendor = Role::where('name', 'vendor')->first();
        $user = Role::where('name', 'user')->first();

        // Define permission mappings
        $rolePermissions = [
            'super-admin' => [
                // User Management
                'block.user',
                'unblock.user',
                'verify.vendor_account',

                // Vendor Management
                'view.vendor',
                'verify.vendor',
                'suspend.vendor',
                'restore.vendor',

                // Parts Management
                'view.part',
                'remove.part',
                'view.public_parts',
                'search.part',

                // Orders Management
                'view.all_orders',
                'resolve.order_dispute',
                'view.order',

                // Reviews Management
                'moderate.review',

                // Reports Management
                'view.report',
                'update.report_status',
                'take_action.report',

                // System Access
                'view.admin_dashboard',
                'view.system_logs',
                'view.system_stats',
            ],

            'vendor' => [
                // Vendor Self-Management
                'update.vendor_profile',
                'manage.vendor_pickup_points',
                'manage.vendor_socials',
                'view.vendor_dashboard',

                // Parts Management
                'create.part',
                'update.part',
                'delete.part',
                'view.vendor_parts',
                'view.public_parts',
                'search.part',

                // Orders Management
                'view.vendor_orders',
                'update.order_status',
                'view.order',

                // Reviews Management
                'respond.review',

                // Reports Management
                'view.vendor_reports',
                'create.report',
            ],

            'user' => [
                // Public Parts Access
                'view.public_parts',
                'search.part',

                // Orders Management
                'create.order',
                'view.order',
                'cancel.order',

                // Reviews Management
                'create.review',
                'update.review',
                'delete.review',

                // Reports Management
                'create.report',
                'view.report',
            ],
        ];

        // Assign permissions to roles
        $this->assignPermissionsToRole($superAdmin, $rolePermissions['super-admin']);
        $this->assignPermissionsToRole($vendor, $rolePermissions['vendor']);
        $this->assignPermissionsToRole($user, $rolePermissions['user']);

        $this->command->info('Roles and permissions have been seeded successfully!');
    }

    /**
     * Assign permissions to a role
     *
     * @param Role $role
     * @param array $permissionNames
     * @return void
     */
    private function assignPermissionsToRole(Role $role, array $permissionNames): void
    {
        $now = Carbon::now();
        $rolePermissions = [];

        foreach ($permissionNames as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();

            if ($permission) {
                // Check if the relationship already exists
                $exists = DB::table('permission_role')
                    ->where('role_id', $role->id)
                    ->where('permission_id', $permission->id)
                    ->exists();

                if (!$exists) {
                    $rolePermissions[] = [
                        'role_id' => $role->id,
                        'permission_id' => $permission->id,
                        'added_on' => $now,
                    ];
                }
            } else {
                $this->command->warn("Permission '{$permissionName}' not found. Skipping...");
            }
        }

        // Bulk insert all role-permission relationships
        if (!empty($rolePermissions)) {
            DB::table('permission_role')->insert($rolePermissions);
            $this->command->info("Assigned " . count($rolePermissions) . " permissions to role: {$role->name}");
        }
    }
}
