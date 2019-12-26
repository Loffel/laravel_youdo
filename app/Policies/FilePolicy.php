<?php

namespace App\Policies;

use App\User;
use App\File;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function download(User $user, File $file)
    {
        return ($user->id === $file->user_id) || ($user->id === $file->task->user->id) || $user->is_admin;
    }
}
