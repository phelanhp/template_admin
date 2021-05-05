<?php

use Modules\Base\Model\Status;

return [
    'name'       => trans('Dashboard::language.name'),
    'route'      => route('dashboard'),
    'sort'       => 1,
    'active'     => TRUE,
    'icon'       => 'fas fa-columns',
    'middleware' => [],
    'group'      => []
];
