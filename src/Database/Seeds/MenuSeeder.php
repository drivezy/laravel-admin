<?php

namespace Drivezy\LaravelAdmin\Database\Seeds;

use Drivezy\LaravelAdmin\Models\Menu;

/**
 * Class MenuSeeder
 * @package Drivezy\LaravelAdmin\Database\Seeds
 */
class MenuSeeder {
    /**
     *
     */
    public function run () {
        $records = [
            [
                'id'               => 1,
                'name'             => 'Module',
                'url'              => 'modules',
                'includes'         => '',
                'route'            => 'api/record/module',
                'page_id'          => 1,
                'order_definition' => 'created_at,desc',
            ],
            [
                'id'               => 2,
                'name'             => 'Menu',
                'url'              => 'menus',
                'includes'         => '',
                'route'            => 'api/record/menu',
                'page_id'          => 1,
                'order_definition' => 'created_at,desc',
            ],
            [
                'id'               => 3,
                'name'             => 'Model',
                'url'              => 'models',
                'includes'         => '',
                'route'            => 'api/record/dataModel',
                'page_id'          => 1,
                'order_definition' => 'created_t,desc',
            ],
            [
                'id'               => 4,
                'name'             => 'Module Details',
                'url'              => 'module/:id',
                'includes'         => 'menus.menu',
                'route'            => 'api/record/module',
                'page_id'          => 2,
                'order_definition' => '',
            ],
            [
                'id'               => 5,
                'name'             => 'Menu Details',
                'url'              => 'menus/:id',
                'includes'         => 'modules.module,roles.role,permissions.permission,page',
                'route'            => 'api/record/menu',
                'page_id'          => 2,
                'order_definition' => '',
            ],
            [
                'id'               => 6,
                'name'             => 'Model Details',
                'url'              => 'model/:id',
                'includes'         => 'columns.reference_model,relationships.model,roles.role',
                'route'            => '',
                'page_id'          => 2,
                'order_definition' => '',
            ],

        ];

        foreach ( $records as $record )
            Menu::create($record);
    }
}