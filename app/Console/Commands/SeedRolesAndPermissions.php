<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;
use App\Models\Permission;

class SeedRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:roles-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed default roles and permissions';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $roles = [
            'super_admin',
            'manager',
        ];

        $permissions = [
            'article_table_admin',
            'category_printer_admin',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
            $this->info("Role '{$roleName}' created.");
        }

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
            $this->info("Permission '{$permissionName}' created.");
        }

        $adminRole = Role::where('name', 'manager')->first();

        if ($adminRole) {
            $adminRole->permissions()->sync(Permission::whereIn('name', ['article_table_admin'])->pluck('id'));
            $this->info("Relevant permissions assigned to manager role.");
        }

        $this->info('Roles and permissions seeding completed.');
    }
}
