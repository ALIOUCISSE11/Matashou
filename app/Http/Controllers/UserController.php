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

        // Synchronisez les rôles de l'utilisateur avec ceux fournis dans la requête
        $user->syncRoles($request->roles);

        // Redirigez avec un message de succès
        return redirect()->route('users.index')->with('success', 'Les rôles de l\'utilisateur ont été mis à jour avec succès.');
    }

    public function assignRoleToUser()
    {
        $user = User::where('name', 'Aliou Cisse')->first(); // Récupérer l'utilisateur par son nom

        if ($user) {
            $role = Role::where('name', 'admin')->first(); // Récupérer le rôle par son nom
            if ($role) {
               // $user->assignRole($role); // Assigner le rôle à l'utilisateur
                // Vous pouvez également utiliser la méthode syncRoles pour remplacer les rôles existants par le nouveau rôle
                 $user->syncRoles([$role]); 
                return "Rôle attribué avec succès à l'utilisateur.";
            } else {
                return "Le rôle spécifié n'existe pas.";
            }
        } else {
            return "Utilisateur non trouvé.";
        }
    }
}