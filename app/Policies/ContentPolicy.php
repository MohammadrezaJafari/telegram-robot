<?php

namespace App\Policies;

use App\Domain\Content\Model\Content;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Access\Gate;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(Gate $gate)
    {
    }

    public function update(User $user, Content $post)
    {
//        var_dump(2);die;
        return false;
        return $user->id === $post->user_id;
    }
}
