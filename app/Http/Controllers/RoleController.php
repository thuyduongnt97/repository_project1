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
            'name'=>"required|unique:roles|max:255",
            'slug' => 'required|unique:roles|max:255',
        ]);
        if($validated->fails()){
            return response()->json(['error'=>$validated->errors()->all()]);
        }
        $result = $this->roleRepository->create($request->all());
        return response()->json(['success' => true, 'data' => $result], 200);
    }

    public function delete(Request $request){
        $result = $this->roleRepository->deleteById($request->id);
        if($result){
            return response()->json(['result' => true]);
        }
        return response()->json(['result' => false]);
        
    }
    public function update(Request $request) {
        $validated = Validator::make($request->all(), [
            'name'=>"required|unique:roles|max:255",
            'slug' => 'required|unique:roles|max:255',
        ]);
        if($validated->fails()){
            return response()->json(['error'=>$validated->errors()->all()]);
        }
        $payload = [
            'name' => $request->name,
            'slug' => $request->slug
        ];
        $result = $this->roleRepository->update($request->id, $payload);
        if($result){
            return response()->json(['result' => true]);
        }
        return response()->json(['result' => false]);
    }
}
