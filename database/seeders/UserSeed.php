<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeed extends Seeder
{
    public function run(): void
    {
        $superadmin = User::create([
            'username' => 'SUPER',
            'email' => 'carecenter@re-cycles-france.fr',
            'name' => 'Administrateur root',
            'firstname' => 'Administrateur',
            'lastname' => 'Root',
            'password' => bcrypt('superadmin'),
        ]);
        $superadmin->assignRole('superadmin');

        $admin = User::create([
            'username' => 'RLOMVIN',
            'email' => 'vincent.lombard@re-cycles-france.fr',
            'name' => 'Vincent LOMBARD',
            'firstname' => 'Vincent',
            'lastname' => 'LOMBARD',
            'password' => bcrypt('RLOMVIN'),
        ]);
        $admin->assignRole('admin');

        $rfremax = User::create([
            'username' => 'RFREMAX',
            'email' => 'maxime.freydrich@re-cycles-france.fr',
            'name' => 'Maxime FREYDRICH',
            'firstname' => 'Maxime',
            'lastname' => 'FREYDRICH',
            'password' => bcrypt('RFREMAX'),
        ]);
        $rfremax->assignRole('admin');

        $rniomel = User::create([
            'username' => 'RNIOMEL',
            'email' => 'melvin.nion@re-cycles-france.fr',
            'name' => 'Melvin NION',
            'firstname' => 'Melvin',
            'lastname' => 'NION',
            'password' => bcrypt('RNIOMEL'),
        ]);
        $rniomel->assignRole('agent');

        $rmetyan = User::create([
            'username' => 'RMETYAN',
            'email' => 'yannick.metayer@re-cycles-france.fr',
            'name' => 'Yannick METAYER',
            'firstname' => 'Yannick',
            'lastname' => 'METAYER',
            'password' => bcrypt('RMETYAN'),
        ]);
        $rmetyan->assignRole('technician');

        $rdorale = User::create([
            'username' => 'RDORALE',
            'email' => 'alexandre.dore@re-cycles-france.fr',
            'name' => 'Alexandre DORE',
            'firstname' => 'Alexandre',
            'lastname' => 'DORE',
            'password' => bcrypt('RDORALE'),
        ]);
        $rdorale->assignRole('quality');

    }
}
