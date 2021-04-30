<?php
return [
    'name' => 'Setting',
    'route' => route('get.setting.list'),
    'sort' => 99,
    'active'=> TRUE,
    'icon' => 'fas fa-cog',
    'middleware' => ['settings'],
    'group' => []
];
