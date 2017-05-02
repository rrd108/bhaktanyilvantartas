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
            'action' => ['index', 'view'],
        ],
        [
            'role' => 'admin',
            'controller' => 'Bhaktas',
            'action' => ['edit'],
        ],
        [
            'role' => 'admin',
            'controller' => 'Services',
            'action' => ['add', 'edit', 'view'],
        ],
    ]
];