<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\PermissionRepositoryInterface;
use App\Repositories\RolePermissionRepositoryInterface;

class RolePermissionController extends Controller
{
    private $permissionRepository;
    private $roleRepository;
    private $rolepermissionRepository;
    
    public function __construct(PermissionRepositoryInterface $permissionRepository, RoleRepositoryInterface $roleRepository, RolePermissionRepositoryInterface $rolepermissionRepository) {
        $this->middleware('auth');
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
        $this->rolepermissionRepository = $rolepermissionRepository;
    }
    
    public function index() {
        $roles = $this->roleRepository->all();
        $permissions = $this->permissionRepository->all();
        $role_permission = $this->rolepermissionRepository->all();
        return view('page.setting.role_permission', compact('roles', 'permissions', 'role_permission'));
    }

    public function update(Request $request){
        $this->rolepermissionRepository->deleteAll();
        $this->rolepermissionRepository->insertMulti($request->role_permission);
        return true;
    }
}
