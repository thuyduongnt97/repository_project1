<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRoleRepositoryInterface;

class UserRoleController extends Controller
{
    private $userRepository;
    private $roleRepository;
    private $userRoleRepository;
    
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository, UserRoleRepositoryInterface $userRoleRepository) {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->userRoleRepository = $userRoleRepository;
    }
    
    public function index() {
        $roles = $this->roleRepository->all();
        $users = $this->userRepository->all();
        $user_role = $this->userRoleRepository->all();
        return view('page.setting.user_role', compact('roles', 'users', 'user_role'));
    }

    public function add(Request $request){
        $result = $this->userRoleRepository->add($request->user_role);
        return "true";
    }
    public function delete(Request $request) {
        $result = $this->userRoleRepository->delete($request->user_role);
        return $result;
    }
}
