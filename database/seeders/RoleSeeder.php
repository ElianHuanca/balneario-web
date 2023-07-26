<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=> 'Admin']);
        Permission::create(['name' => 'gestionar material'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar producto'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar cliente'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar factura'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar categoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar orden de manufactura'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar fabricacion'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar operacion'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar almacen'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar lote'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar proveedor'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar venta'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar compra'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar unidad de medida'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar lista de material'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar cliente'])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar '])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar '])->syncRoles([$role1]);
        Permission::create(['name' => 'gestionar '])->syncRoles([$role1]);



    }
}
