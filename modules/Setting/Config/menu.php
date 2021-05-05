<?php
return [
    'name' => trans('Setting::language.name'),
    'route' => route('get.setting.list'),
    'sort' => 99,
    'active'=> TRUE,
    'icon' => 'fas fa-cog',
    'middleware' => ['settings'],
    'group' => []
];
