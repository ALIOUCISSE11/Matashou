<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Définir les permissions
        $permissions = [
            // Permissions pour les articles
            'view articles',
            'create articles',
            'edit articles',
            'delete articles',

            // Permissions pour les catégories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            // Permissions pour les commandes
            'view commandes',
            'create commandes',
            'edit commandes',
            'delete commandes',

            // Permissions pour les clients
            'view clients',
            'create clients',
            'edit clients',
            'delete clients',

            // Permissions pour les utilisateurs
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Permissions pour les rôles
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            // Permissions pour les permissions
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
        ];

        // Créer les permissions s'ils n'existent pas déjà
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Créer le rôle administrateur
        $adminRole = Role::create(['name' => 'admin']);

        // Assigner toutes les permissions à l'administrateur
        $adminRole->givePermissionTo(Permission::all());

        // Créer le rôle utilisateur
        $userRole = Role::create(['name' => 'user']);

        // Assigner des permissions d'affichage aux utilisateurs
        $userRole->givePermissionTo([
            'view articles',
            'view categories',
            'view commandes',
            'view clients',
        ]);
    }
}
