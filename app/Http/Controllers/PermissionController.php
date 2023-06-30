<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Validator;


class PermissionController extends Controller
{
    private $permissionRepository;
    
    public function __construct(PermissionRepositoryInterface $permissionRepository) {
        $this->middleware('auth');
        $this->permissionRepository = $permissionRepository;
    }
    public function index() {
        $permissions = $this->permissionRepository->all();
        return view('page.setting.permission', compact('permissions'));
    }
    public function create(Request $request) {
        $validated = Validator::make($request->all(), [
            'name'=>"required|unique:roles|max:255",
            'slug' => 'required|unique:roles|max:255',
        ]);
        if($validated->fails()){
            return response()->json(['error'=>$validated->errors()->all()]);
        }
        $result = $this->permissionRepository->create($request->all());
        return response()->json(['success' => true, 'data' => $result], 200);
    }

    public function delete(Request $request){
        $result = $this->permissionRepository->deleteById($request->id);
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
        $result = $this->permissionRepository->update($request->id, $payload);
        if($result){
            return response()->json(['result' => true]);
        }
        return response()->json(['result' => false]);
    }
}
