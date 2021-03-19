<?php
return [
    'Users.SimpleRbac.permissions' => [
        [
            'role' => '*',
            'controller' => 'Pages',
            'action' => ['display'],
        ],
        [
            'role' => '*',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => ['profile', 'logout'],
        ],
        [
            'role' => '*',
            'controller' => 'Departments',
            'action' => ['members'],
        ],
        [
            'role' => '*',
            'controller' => 'Bhaktas',
            'action' => ['index', 'searchOnField', 'view', 'withoutService'],
        ],
        [
            'role' => 'admin',
            'controller' => 'Bhaktas',
            'action' => ['add', 'edit','endVolunteer'],
        ],
        [
            'role' => 'admin',
            'controller' => 'Services',
            'action' => ['add', 'edit', 'view'],
        ],
        [
            'role' => 'admin',
            'controller' => 'Departments',
            'action' => ['index', 'add', 'edit'],
        ],
    ]
];
