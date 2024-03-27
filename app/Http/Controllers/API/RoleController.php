<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
/**
*@OA\Post(
*    path="/api/roles",
*    summary="Roles data",
*    tags={"Roles"},
*@OA\Parameter(
*    name="name",
*    in="query",
*    description="",
*    required=true,
*    @OA\Schema(type="string")
*),
*@OA\Parameter(
*    name="criteria",
*    in="query",
*    description="Some optional other parameter",
*    required=false,
*    @OA\Schema(type="string")
*),
*@OA\Response(
*    response="200",
*    description="Returns some sample category things",
*    @OA\JsonContent()
*),
*@OA\Response(
*    response="400",
*    description="Error: Bad request. When required parameters were not supplied.",
*),
*)
*/


class RoleController extends Controller
{
    // Method to fetch all roles
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::all();
        return response()->json($roles);
    }

    // Method to fetch a specific role by ID
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('view', $role);

        return response()->json($role);
    }

    // Method to create a new role
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role = Role::create($request->only('name'));

        return response()->json(['role' => $role, 'message' => 'Role created successfully.'], 201);
    }

    // Method to update an existing role
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('update', $role);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role->update($request->only('name'));

        return response()->json(['role' => $role, 'message' => 'Role updated successfully.'], 200);
    }

    // Method to delete a role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('delete', $role);

        $role->delete();

        return response()->json(["message" => "Role has been deleted successfully."], 200);
    }
}
