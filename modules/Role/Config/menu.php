<?php

return [
    'id'         => 'role',
    'name'       => trans('Roles'),
    'route'      => route('get.role.list'),
    'sort'       => 98,
    'active'     => true,
    'icon'       => 'fas fa-user-tag',
    'middleware' => ['roles'],
    'group'      => []
];
