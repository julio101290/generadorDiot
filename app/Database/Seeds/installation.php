<?php

namespace App\Database\Seeds;

use CodeIgniter\Config\Services;
use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
use julio101290\boilerplate\Models\MenuModel;

/**
 * Class BoilerplateSeeder.
 */
class Installation extends Seeder
{
    /**
     * @var Authorize
     */
    protected $authorize;

    /**
     * @var Db
     */
    protected $db;

    /**
     * @var Users
     */
    protected $users;

    //protected $menu;

    public function __construct()
    {
        $this->authorize = Services::authorization();
        $this->db = \Config\Database::connect();
        $this->users = new UserModel();
    }

    public function run()
    {



        // User
        $this->users->save(new User([
            'email'    => 'admin@admin.com',
            'username' => 'admin',
            'password' => 'super-admin',
            'active'   => '1',
        ]));

        $this->users->save(new User([
            'email'    => 'user@user.com',
            'username' => 'user',
            'password' => 'super-user',
            'active'   => '1',
        ]));

        // Role
        $this->authorize->createGroup('admin', 'Administrators. The top of the food chain.');
        $this->authorize->createGroup('member', 'Member everyday member.');
       
        $this->authorize->createPermission('back-office', 'User can access to the administration panel.');
        $this->authorize->createPermission('manage-user', 'User can create, delete or modify the users.');
        $this->authorize->createPermission('role-permission', 'User can edit and define permissions for a role.');
        $this->authorize->createPermission('menu-permission', 'User cand create, delete or modify the menu.');
       
        $this->authorize->createPermission('empresas-permisos', 'Crear permiso para el catalogo de empresas.');
        $this->authorize->createPermission('email-permiso', 'Permisos para la configuracion del correo electronico');
        $this->authorize->createPermission('categorias-permission', 'Permiso para entrar a editar las categorias');
        $this->authorize->createPermission('custumers-permission', 'Permission for add, update and delete for custumers.');
        $this->authorize->createPermission('products-permission', 'Permisos para acceder al catalogo de productos');

        $this->authorize->createPermission('branchoffices-permission', 'Permiso para las sucursales');
        $this->authorize->createPermission('costcenter-permission', 'Permiso Centro de costo');
        $this->authorize->createPermission('storages-permission', 'Permiso para los almacenes');

        // Assign Permission to role
        $this->authorize->addPermissionToGroup('back-office', 'admin');
        $this->authorize->addPermissionToGroup('manage-user', 'admin');
        $this->authorize->addPermissionToGroup('role-permission', 'admin');
        $this->authorize->addPermissionToGroup('menu-permission', 'admin');
        $this->authorize->addPermissionToGroup('back-office', 'member');

        $this->authorize->addPermissionToGroup('diot-permission', 'admin');
        $this->authorize->addPermissionToGroup('settingsrfc-permission', 'admin');


        $this->authorize->addUserToGroup(1, 'admin');
        $this->authorize->addUserToGroup(1, 'member');
        $this->authorize->addUserToGroup(2, 'member');
        
        $this->authorize->addPermissionToGroup('settingsrfc-permission', 'admin');
        $this->authorize->addPermissionToGroup('diot-permission', 'admin');



        // Assign Permission to user
        $this->authorize->addPermissionToUser('back-office', 1);
        $this->authorize->addPermissionToUser('manage-user', 1);
        $this->authorize->addPermissionToUser('role-permission', 1);
        $this->authorize->addPermissionToUser('menu-permission', 1);
        $this->authorize->addPermissionToUser('back-office', 2);
        $this->authorize->addPermissionToUser('menu-permission', 1);
        $this->authorize->addPermissionToUser('diot-permission', 1);
        $this->authorize->addPermissionToUser('settingsrfc-permission', 1);


        




        $menu = array(
            array('id' => '1','parent_id' => '0','active' => '1','title' => 'Tablero','icon' => 'fas fa-tachometer-alt','route' => 'admin','sequence' => '1','created_at' => '2023-04-26 15:53:38','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '2','parent_id' => '0','active' => '1','title' => 'Manejo de Usuarios','icon' => 'fas fa-user','route' => '#','sequence' => '5','created_at' => '2023-04-26 15:53:38','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '3','parent_id' => '2','active' => '1','title' => 'Perfil','icon' => 'fas fa-user-edit','route' => 'admin/user/profile','sequence' => '6','created_at' => '2023-04-26 15:53:38','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '4','parent_id' => '2','active' => '1','title' => 'Admon. Usuarios','icon' => 'fas fa-users','route' => 'admin/user/manage','sequence' => '7','created_at' => '2023-04-26 15:53:38','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '5','parent_id' => '2','active' => '1','title' => 'Permisos','icon' => 'fas fa-user-lock','route' => 'admin/permission','sequence' => '8','created_at' => '2023-04-26 15:53:38','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '6','parent_id' => '2','active' => '1','title' => 'Roles','icon' => 'fas fa-users-cog','route' => 'admin/role','sequence' => '9','created_at' => '2023-04-26 15:53:38','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '7','parent_id' => '2','active' => '1','title' => 'Menu','icon' => 'fas fa-stream','route' => 'admin/menu','sequence' => '10','created_at' => '2023-04-26 15:53:38','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '8','parent_id' => '0','active' => '1','title' => 'DIOT','icon' => 'fab fa-acquisitions-incorporated','route' => 'admin/diot','sequence' => '2','created_at' => '2023-04-26 16:21:33','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '9','parent_id' => '0','active' => '1','title' => 'RFC Conf','icon' => 'far fa-address-card','route' => 'admin/settingsrfc','sequence' => '4','created_at' => '2023-04-26 23:14:28','updated_at' => '2023-04-29 16:35:35'),
            array('id' => '10','parent_id' => '0','active' => '1','title' => 'Archivos DIOT','icon' => 'far fa-file-excel','route' => 'admin/diot/diotArchivo','sequence' => '3','created_at' => '2023-04-29 16:20:34','updated_at' => '2023-04-29 16:35:35')
          );

        //$this->db->table('menu')->insertBatch($menu);

        foreach ($menu as $key => $value) {
            $this->db->table('menu')->replace($value);
        }


        $groups_menu = array(
            array('id' => '6','group_id' => '1','menu_id' => '6'),
            array('id' => '7','group_id' => '1','menu_id' => '7'),
            array('id' => '11','group_id' => '1','menu_id' => '1'),
            array('id' => '12','group_id' => '2','menu_id' => '1'),
            array('id' => '13','group_id' => '1','menu_id' => '2'),
            array('id' => '14','group_id' => '2','menu_id' => '2'),
            array('id' => '15','group_id' => '1','menu_id' => '3'),
            array('id' => '16','group_id' => '2','menu_id' => '3'),
            array('id' => '17','group_id' => '1','menu_id' => '4'),
            array('id' => '18','group_id' => '1','menu_id' => '5'),
            array('id' => '19','group_id' => '1','menu_id' => '8'),
            array('id' => '20','group_id' => '1','menu_id' => '9'),
            array('id' => '21','group_id' => '1','menu_id' => '10'),
            array('id' => '22','group_id' => '2','menu_id' => '10')
          );

        foreach ($groups_menu as $key => $value) {
            $this->db->table('groups_menu')->replace($value);
        }
    }

    public function down()
    {
        //
    }
}