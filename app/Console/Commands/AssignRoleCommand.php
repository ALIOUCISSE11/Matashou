<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\UserController;

class AssignRoleCommand extends Command
{
    protected $signature = 'assign:role';

    protected $description = 'Assign the admin role to a user';

    protected $userController;

    public function __construct(UserController $userController)
    {
        parent::__construct();
        $this->userController = $userController;
    }

    public function handle()
    {
        $this->info($this->userController->assignRoleToUser());
    }
}
