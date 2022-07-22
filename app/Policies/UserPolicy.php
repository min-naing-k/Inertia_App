<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
  use HandlesAuthorization;

  public function create(User $user)
  {
    return $user->role === 'Manager';
  }

  public function edit(User $user, User $model)
  {
    if (($user->role === 'Stuff' && $model->role === 'Stuff') || $user->role === 'Manager') {
      return true;
    }

    return false;
  }
}
