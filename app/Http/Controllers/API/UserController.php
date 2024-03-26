<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
//Méthode pour afficher tous les utilisateurs
//http://localhost:8000/api/users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Méthode pour afficher un utilisateur spécifique
    //http://localhost:8000/api/users/6
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Méthode pour créer un nouvel utilisateur
    //http://localhost:8000/api/users
    public function store(Request $request)
    {
        $userData = $request->all();
        $userData['password'] = Hash::make($request->get('password'));

        $user = User::create($userData);

        return response()->json($user, 201);
    }

    // Méthode pour mettre à jour un utilisateur existant
//    http://localhost:8000/api/users/{id}
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Update user data except for the password
        $userData = $request->except('password');

        // Check if the request contains a new password
        if ($request->has('password')) {
            $userData['password'] = Hash::make($request->get('password'));
        }

        $user->update($userData);

        return response()->json($user, 200);
    }

    // Méthode pour supprimer un utilisateur
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
