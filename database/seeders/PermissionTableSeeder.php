<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Voir les décaissements',
            'Créer les décaissements',
            'Modifier les décaissements',
            'Imprimer les décaissements',

            'Voir les encaissements',
            'Créer les encaissements',
            'Modifier les encaissements',
            'Imprimer les encaissements',
            // 'delete-decaissement',
            'Contrôler la cloture de la caisse',
            'Cloture de caisse',
            'Faire l\'inventaire de la caisse',

            'Voir les immobilisations',
            'Modifier les immobilisations',
            'Supprimer/modifier les immobilisations au rebut',


            'Voir les marchandises',
            'Faire l\'inventaire des marchandises',

            'Voir les tiers',
            'Créer un tiers',
            'Supprimer un tiers',
            'Modifier une opération sur un tiers',
            'Faire une opération sur un tiers',
            'Supprimer une opération sur un tiers',

            'Voir le tableau de bord de la caisse',


            'Voir le tableau de bord des tiers',


            'Gerer les utilisateurs',



            'Gerer les employés',

            'Acceder au panneau de configuration',
            'Acceder à l\'historique de connexion',
            'Gérer les rôles',
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
