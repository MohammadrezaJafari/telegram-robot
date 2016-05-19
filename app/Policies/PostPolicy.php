<?php

namespace App\Policies;

use App\Domain\Content\Model\Content;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function update(User $user, Content $post)
    {
//        var_dump(2);die;
        return true;
        return $user->id === $post->user_id;
    }
}
