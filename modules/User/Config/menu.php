<?php

use Modules\Base\Model\Status;

return [
    'name'       => 'Users',
    'route'      => route('get.user.list'),
    'sort'       => 97,
    'active'     => TRUE,
    'icon'       => 'fas fa-user',
    'middleware' => ['users'],
    'group'      => []
];
