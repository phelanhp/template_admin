<?php
return [
    'id'         => 'setting',
    'name'       => trans('Settings'),
    'route'      => route('get.setting.list'),
    'sort'       => 99,
    'active'     => true,
    'icon'       => 'fas fa-cog',
    'middleware' => ['settings'],
    'group'      => []
];
