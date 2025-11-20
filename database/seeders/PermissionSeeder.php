<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            // -----------------------------
            // USER MANAGEMENT (Admin/Super Admin)
            // -----------------------------
            // [
            //     'name' => 'view.user',
            //     'type' => 'policy',
            //     'description' => 'View user details',
            //     'model' => 'User'
            // ],
            [
                'name' => 'block.user',
                'type' => 'policy',
                'description' => 'Block a user account',
                'model' => 'User'
            ],
            [
                'name' => 'unblock.user',
                'type' => 'policy',
                'description' => 'Unblock a user account',
                'model' => 'User'
            ],
            [
                'name' => 'verify.vendor_account',
                'type' => 'policy',
                'description' => 'Verify vendor account',
                'model' => 'User'
            ],

            // -----------------------------
            // VENDOR
            // -----------------------------
            // Vendor self-management
            [
                'name' => 'update.vendor_profile',
                'type' => 'policy',
                'description' => 'Update vendor profile',
                'model' => 'Vendor'
            ],
            [
                'name' => 'manage.vendor_pickup_points',
                'type' => 'policy',
                'description' => 'Manage vendor pickup points',
                'model' => 'PickupPoint'
            ],
            [
                'name' => 'manage.vendor_socials',
                'type' => 'policy',
                'description' => 'Manage vendor social media',
                'model' => 'Vendor'
            ],
            [
                'name' => 'view.vendor_dashboard',
                'type' => 'policy',
                'description' => 'View vendor dashboard',
                'model' => 'Vendor'
            ],

            // Admin vendor controls
            [
                'name' => 'view.vendor',
                'type' => 'policy',
                'description' => 'View vendor details',
                'model' => 'Vendor'
            ],
            [
                'name' => 'verify.vendor',
                'type' => 'policy',
                'description' => 'Verify vendor',
                'model' => 'Vendor'
            ],
            [
                'name' => 'suspend.vendor',
                'type' => 'policy',
                'description' => 'Suspend vendor',
                'model' => 'Vendor'
            ],
            [
                'name' => 'restore.vendor',
                'type' => 'policy',
                'description' => 'Restore vendor',
                'model' => 'Vendor'
            ],

            // -----------------------------
            // PARTS
            // -----------------------------
            // Vendor controls
            [
                'name' => 'create.part',
                'type' => 'policy',
                'description' => 'Create a new part',
                'model' => 'Part'
            ],
            [
                'name' => 'update.part',
                'type' => 'policy',
                'description' => 'Update part details',
                'model' => 'Part'
            ],
            [
                'name' => 'delete.part',
                'type' => 'policy',
                'description' => 'Delete a part',
                'model' => 'Part'
            ],
            [
                'name' => 'view.vendor_parts',
                'type' => 'policy',
                'description' => 'View vendor parts',
                'model' => 'Part'
            ],

            // Public/buyer
            [
                'name' => 'view.public_parts',
                'type' => 'policy',
                'description' => 'View public parts',
                'model' => 'Part'
            ],
            [
                'name' => 'search.part',
                'type' => 'policy',
                'description' => 'Search for parts',
                'model' => 'Part'
            ],

            // Admin controls
            [
                'name' => 'view.part',
                'type' => 'policy',
                'description' => 'View part details',
                'model' => 'Part'
            ],
            [
                'name' => 'remove.part',
                'type' => 'policy',
                'description' => 'Remove a part',
                'model' => 'Part'
            ],

            // -----------------------------
            // ORDERS
            // -----------------------------
            // Buyer
            [
                'name' => 'create.order',
                'type' => 'policy',
                'description' => 'Create a new order',
                'model' => 'Order'
            ],
            [
                'name' => 'view.order',
                'type' => 'policy',
                'description' => 'View order details',
                'model' => 'Order'
            ],
            [
                'name' => 'cancel.order',
                'type' => 'policy',
                'description' => 'Cancel an order',
                'model' => 'Order'
            ],

            // Vendor
            [
                'name' => 'view.vendor_orders',
                'type' => 'policy',
                'description' => 'View vendor orders',
                'model' => 'Order'
            ],
            [
                'name' => 'update.order_status',
                'type' => 'policy',
                'description' => 'Update order status',
                'model' => 'Order'
            ],

            // Admin
            [
                'name' => 'view.all_orders',
                'type' => 'policy',
                'description' => 'View all orders',
                'model' => 'Order'
            ],
            [
                'name' => 'resolve.order_dispute',
                'type' => 'policy',
                'description' => 'Resolve order dispute',
                'model' => 'Order'
            ],

            // -----------------------------
            // REVIEWS
            // -----------------------------
            [
                'name' => 'create.review',
                'type' => 'policy',
                'description' => 'Create a review',
                'model' => 'Review'
            ],
            [
                'name' => 'update.review',
                'type' => 'policy',
                'description' => 'Update a review',
                'model' => 'Review'
            ],
            [
                'name' => 'delete.review',
                'type' => 'policy',
                'description' => 'Delete a review',
                'model' => 'Review'
            ],
            [
                'name' => 'respond.review',
                'type' => 'policy',
                'description' => 'Respond to a review',
                'model' => 'Review'
            ],
            [
                'name' => 'moderate.review',
                'type' => 'policy',
                'description' => 'Moderate reviews',
                'model' => 'Review'
            ],

            // -----------------------------
            // REPORTS
            // -----------------------------
            [
                'name' => 'create.report',
                'type' => 'policy',
                'description' => 'Create a report',
                'model' => 'Report'
            ],
            [
                'name' => 'view.report',
                'type' => 'policy',
                'description' => 'View report details',
                'model' => 'Report'
            ],
            [
                'name' => 'view.vendor_reports',
                'type' => 'policy',
                'description' => 'View vendor reports',
                'model' => 'Report'
            ],
            [
                'name' => 'update.report_status',
                'type' => 'policy',
                'description' => 'Update report status',
                'model' => 'Report'
            ],
            [
                'name' => 'take_action.report',
                'type' => 'policy',
                'description' => 'Take action on report',
                'model' => 'Report'
            ],

            // -----------------------------
            // ADMIN DASHBOARD & SYSTEM
            // -----------------------------
            [
                'name' => 'view.admin_dashboard',
                'type' => 'policy',
                'description' => 'View admin dashboard',
                'model' => null
            ],
            [
                'name' => 'view.system_logs',
                'type' => 'policy',
                'description' => 'View system logs',
                'model' => null
            ],
            [
                'name' => 'view.system_stats',
                'type' => 'policy',
                'description' => 'View system statistics',
                'model' => null
            ],
        ];

        foreach ($permissions as $perm) {
            \RbacAuth\Models\Permission::firstOrCreate($perm);
        }
    }
}
