<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUserRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:user-roles {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check roles assigned to a user by email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $this->info('Roles for user ' . $email . ':');
            $roles = $user->getRoleNames();
            if ($roles->isEmpty()) {
                $this->info('No roles assigned.');
            } else {
                foreach ($roles as $role) {
                    $this->info('- ' . $role);
                }
            }
        } else {
            $this->error('User with email ' . $email . ' not found.');
        }
    }
}
