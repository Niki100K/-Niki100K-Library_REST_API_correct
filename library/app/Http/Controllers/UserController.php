<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userService->all()->pluck('name', 'email');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $userData = $request->only(['name', 'phone', 'email', 'password']);
        return $this->userService->create($userData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            return response()->json(['error' => 'User not found']);
        }
    
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $existingUser = $this->userService->findById($id);
        if (!$existingUser) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($request->has('email') && $request->input('email') !== $existingUser->email) {
            $request->validate([
                'email' => 'unique:users',
            ]);
        }

        $userData = $request->only(['name', 'phone', 'email']);
        return $this->userService->update($id, $userData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $this->userService->delete($id);
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
