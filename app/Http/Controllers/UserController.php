<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index() {
        $users = $this->userRepository->all();
        return view('page.setting.user', compact('users'));
    }
    public function create(Request $request) {
        $validated = Validator::make($request->all(), [
            'name'=>"required|max:255",
            'email' => 'required|unique:users|max:255',
            'password' => 'required'
        ]);
        if($validated->fails()){
            return response()->json(['error'=>$validated->errors()->all()]);
        }
        $result = $this->userRepository->create($request->all());
        return response()->json(['success' => true, 'data' => $result], 200);
    }
    
}
