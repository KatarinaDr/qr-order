<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\ValidationException;

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
    protected $description = 'Create a new user and assign a role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('<fg=blue>Creating a new user...</>');

        $email = $this->ask('Enter user email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $this->line("<fg=yellow>User with email '{$email}' already exists. Updating details...</>");
            $name = $this->ask('Enter user name');
            $password = $this->secret('Enter user password');
            $roles = Role::pluck('name')->toArray();
            $roleName = $this->choice('Choose a role for the user', $roles);

            $role = Role::where('name', $roleName)->first();

            $user->update([
                'name' => $name,
                'password' => bcrypt($password),
                'role_id' => $role->id,
            ]);

            $this->line("<fg=green>User '{$user->name}' updated successfully with role '{$role->name}'.</>");

        } else {
            $name = $this->ask('Enter user name');
            $password = $this->secret('Enter user password');
            $roles = Role::pluck('name')->toArray();
            $roleName = $this->choice('Choose a role for the user', $roles);
            $role = Role::where('name', $roleName)->first();

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'role_id' => $role->id,
            ]);

            $this->line("<fg=green>User '{$user->name}' created successfully with role '{$role->name}'.</>");
        }
    }
}
