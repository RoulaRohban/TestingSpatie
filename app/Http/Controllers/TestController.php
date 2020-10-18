<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TestController extends Controller
{
    function test(){
        $users = User::role('writer')->get(); // Returns only users with the role 'writer'
        $users = User::permission('edit articles')->get(); // Returns only users with the permission 'edit articles' (inherited or directly)
        $all_users_with_all_their_roles = User::with('roles')->get();
        $all_users_with_all_direct_permissions = User::with('permissions')->get();
        $all_roles_in_database = Role::all()->pluck('name');
        $users_without_any_roles = User::doesntHave('roles')->get();
        // get a list of all permissions directly assigned to the user
        $permissionNames = $user->getPermissionNames(); // collection of name strings
        $permissions = $user->permissions; // collection of permission objects

        // get all permissions for the user, either directly, or from roles, or from both
        $permissions = $user->getDirectPermissions();
        $permissions = $user->getPermissionsViaRoles();
        $permissions = $user->getAllPermissions();

        // get the names of the user's roles
        $roles = $user->getRoleNames(); // Returns a collection

        // You may also pass an array
        $user->givePermissionTo(['edit articles', 'delete articles']);

        //A permission can be revoked from a user
        $user->revokePermissionTo('edit articles');

        //check if a user has a permission
        $user->hasPermissionTo('edit articles');

        //check if a user has Any of an array of permissions
        $user->hasAnyPermission(['edit articles', 'publish articles', 'unpublish articles']);

        //check if a user has All of an array of permissions
        $user->hasAllPermissions(['edit articles', 'publish articles', 'unpublish articles']);

        //check if a user has a permission
        $user->can('edit articles');
        $user->can('post.*');

        // You can also assign multiple roles at once
        $user->assignRole('writer', 'admin');

        // check if a user has at least one role from an array of roles
        $user->hasRole(['editor', 'moderator']);
        $user->hasAnyRole(['writer', 'reader']);
        $user->hasAllRoles(Role::all());

        $role = Role::findByName('writer');

        // Check if the user has All direct permissions
        $user->hasAllDirectPermissions(['edit articles', 'delete articles']);

        // Check if the user has Any permission directly
        $user->hasAnyDirectPermission(['create articles', 'delete articles']);



        //Routing
        Route::group(['middleware' => ['role:super-admin']], function () {
            //
        });
        Route::group(['middleware' => ['permission:publish articles']], function () {
            //
        });

        Route::group(['middleware' => ['role:super-admin','permission:publish articles']], function () {
            //
        });

        Route::group(['middleware' => ['role_or_permission:super-admin|edit articles']], function () {
            //
        });

        Route::group(['middleware' => ['role_or_permission:publish articles']], function () {
            //
        });

        //You can protect your controllers


//        public function __construct()
//        {
//            $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
//        }

        //OR

//        public function __construct()
//        {
//            $this->middleware(['role_or_permission:super-admin|edit articles']);
//        }
    }

}

