<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create predefined super_admin and manager users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('<fg=blue>Creating predefined users...</>');

        $users = [
            [
                'email' => 'admin@admin.com',
                'name' => 'Admin',
                'password' => 'admin',
                'role_name' => 'super_admin',
            ],
            [
                'email' => 'manager@manager.com',
                'name' => 'Manager',
                'password' => 'manager',
                'role_name' => 'manager',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::where('email', $userData['email'])->first();
            $role = Role::where('name', $userData['role_name'])->first();

            if (!$role) {
                $this->line("<fg=red>Role '{$userData['role_name']}' does not exist. Skipping user '{$userData['email']}'.</>");
                continue;
            }

            if ($user) {
                $this->line("<fg=yellow>User with email '{$userData['email']}' already exists. Updating details...</>");

                $user->update([
                    'name' => $userData['name'],
                    'password' => bcrypt($userData['password']),
                    'role_id' => $role->id,
                    'license_key' => Str::random(5),
                    'is_active' => true,
                    'can_access_dashboard' => true,
                ]);

                $this->line("<fg=green>User '{$user->name}' updated successfully with role '{$role->name}'.</>");
            } else {
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => bcrypt($userData['password']),
                    'role_id' => $role->id,
                    'license_key' => Str::random(5),
                    'is_active' => true,
                    'can_access_dashboard' => true,
                ]);

                $this->line("<fg=green>User '{$user->name}' created successfully with role '{$role->name}'.</>");
            }
        }

        $this->line('<fg=blue>All predefined users processed successfully!</>');
    }
}
