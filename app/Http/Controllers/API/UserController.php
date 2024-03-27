<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
//Méthode pour afficher tous les utilisateurs
//http://localhost:8000/api/users
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();
        return response()->json($users);
    }

//    public function index()
//    {
//        $users = User::all();
//        return response()->json($users);
//    }

    // Méthode pour afficher un utilisateur spécifique
    //http://127.0.0.1:8000/api/user/5
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view', $user);
        return response()->json($user);
    }


    // Méthode pour créer un nouvel utilisateur
    //http://localhost:8000/api/users
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        // Validate request data
        $request->validate([
            'name' => 'required|string', // Ensure 'name' is required
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);

        // Retrieve the default role ("user")
        $defaultRole = Role::where('name', 'user')->first();

        // If the default role doesn't exist, you may handle it as needed
        if (!$defaultRole) {
            return response()->json(['error' => 'Default role not found.'], 500);
        }

        // Extract user data from the request
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        // Create the user with the default role attached
        $user = $defaultRole->users()->create($userData);

        // Return success response with created user data
        return response()->json(['user' => $user, 'message' => 'User created successfully.'], 201);
    }



    // Méthode pour mettre à jour un utilisateur existant
//    http://localhost:8000/api/users/{id}
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $userData = $request->except('password');

        if ($request->has('password')) {
            $userData['password'] = Hash::make($request->get('password'));
        }
        $user->update($userData);

        return response()->json($user, 200);
    }

    // Méthode pour supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);

        $user->delete();
        return response()->json(["message" => "User has been deleted successfully."], 200);
    }
}
