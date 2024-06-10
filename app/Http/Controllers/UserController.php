<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Assurez-vous que les rôles sont fournis dans la requête
        $request->validate([
            'roles' => 'required|array',
        ]);

        // Récupérer les noms des rôles à partir des IDs fournis dans la requête
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

        // Synchronisez les rôles de l'utilisateur avec ceux fournis dans la requête
        $user->syncRoles($roleNames);

        // Redirigez avec un message de succès
        return redirect()->route('users.index')->with('success', 'Les rôles de l\'utilisateur ont été mis à jour avec succès.');
    }

    public function assignRoleToUser()
    {
        // Récupérer l'utilisateur par la condition 'is_admin'
        $user = User::where('is_admin', true)->first();

        if ($user) {
            $role = Role::where('name', 'admin')->first(); // Récupérer le rôle par son nom
            if ($role) {
                // Assigner le rôle à l'utilisateur
                $user->syncRoles([$role->name]); 
                return "Rôle attribué avec succès à l'utilisateur.";
            } else {
                return "Le rôle spécifié n'existe pas.";
            }
        } else {
            return "Utilisateur non trouvé.";
        }
    }
}
