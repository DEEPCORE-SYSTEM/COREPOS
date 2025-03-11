<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener el rol de admin
        $adminRole = Role::findByName('admin');
        
        // Asignar permisos de todo al rol de admin
        $adminRole->givePermissionTo([
            'todo.view',
            'todo.create',
            'todo.update',
            'todo.delete',
        ]);
    }
}
