<?php

use Modules\Base\Model\Status;

return [
    'name'       => trans('Role::language.module'),
    'route'      => route('get.role.list'),
    'sort'       => 98,
    'active'     => TRUE,
    'icon'       => 'fas fa-user-tag',
    'middleware' => ['roles'],
    'group'      => []
];
