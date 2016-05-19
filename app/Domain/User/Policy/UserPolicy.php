<?php
namespace App\Domain\User\Policy;
use App\Domain\User\Model\User as Base;
use App\User;

class UserPolicy {
    public function edit(User $user, Base $post)
    {
        return $user->id == $post->user_id;
    }

    public function update(User $user, Base $post)
    {

    }

    public function create(User $user, Base $post)
    {
        return true;
    }

    public function store(User $user, Base $post)
    {

    }

    public function destroy(User $user, Base $post)
    {
        return $user->id === $post->user_id;
    }

    public function index(User $user, Base $post)
    {

    }

    public function show(User $user, Base $post)
    {

    }
}