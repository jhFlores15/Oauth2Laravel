<?php

namespace Encuestas_Carozzi\Policies;

use Encuestas_Carozzi\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Encuestas_Carozzi\User  $user
     * @param  \Encuestas_Carozzi\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Encuestas_Carozzi\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Encuestas_Carozzi\User  $user
     * @param  \Encuestas_Carozzi\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Encuestas_Carozzi\User  $user
     * @param  \Encuestas_Carozzi\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Encuestas_Carozzi\User  $user
     * @param  \Encuestas_Carozzi\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Encuestas_Carozzi\User  $user
     * @param  \Encuestas_Carozzi\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
