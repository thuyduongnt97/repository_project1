<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepositoryInterface;
use Illuminate\Support\Facades\Validator;
class RoleController extends Controller
{

    private $roleRepository;
    
    public function __construct(RoleRepositoryInterface $roleRepository) {
        $this->middleware('auth');
        $this->roleRepository = $roleRepository;
    }
    public function index() {
        $roles = $this->roleRepository->all();
        return view('page.setting.role', compact('roles'));
    }
    public function create(Request $request) {
        $validated = Validator::make($request->all(), [
            'name'=>"required",
            'slug' => 'required|unique:roles|max:255',
        ]);
        if($validated->fails()){
            return response()->json(['error'=>$validated->errors()->all()]);
        }
        $result = $this->roleRepository->create($request->all());
        return response()->json(['success' => true, 'data' => $result], 200);
    }
}
