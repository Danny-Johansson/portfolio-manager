<?php

namespace App\Policies;

use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class JobsearchTypePolicy
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

    /**
     * Determine whether the user can view any models.
     */
    public function index(): Response
    {
        return Auth::user()->role->permissions->contains(Permission::firstWhere('name','=','jobsearchTypes_index'))
            ? Response::allow()
            : Response::deny('you are not the chosen one')
        ;
    }


    /**
     * Determine whether the user can view any deleted models.
     */
    public function deleted(): Response
    {
        return Auth::user()->role->permissions->contains(Permission::firstWhere('name','=','jobsearchTypes_deleted'))
            ? Response::allow()
            : Response::deny('you are not the chosen one')
        ;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): Response
    {
        return Auth::user()->role->permissions->contains(Permission::firstWhere('name','=','jobsearchTypes_view'))
            ? Response::allow()
            : Response::deny('you are not the chosen one')
        ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): Response
    {
        return Auth::user()->role->permissions->contains(Permission::firstWhere('name','=','jobsearchTypes_create'))
            ? Response::allow()
            : Response::deny('you are not the chosen one')
        ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): Response
    {
        return Auth::user()->role->permissions->contains(Permission::firstWhere('name','=','jobsearchTypes_update'))
            ? Response::allow()
            : Response::deny('you are not the chosen one')
        ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): Response
    {
        return Auth::user()->role->permissions->contains(Permission::firstWhere('name','=','jobsearchTypes_delete'))
            ? Response::allow()
            : Response::deny('you are not the chosen one')
        ;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(): Response
    {
        return Auth::user()->role->permissions->contains(Permission::firstWhere('name','=','jobsearchTypes_restore'))
            ? Response::allow()
            : Response::deny('you are not the chosen one')
        ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function delete_force(): Response
    {
        return Auth::user()->role->permissions->contains(Permission::firstWhere('name','=','jobsearchTypes_delete_force'))
            ? Response::allow()
            : Response::deny('you are not the chosen one')
        ;
    }
}
