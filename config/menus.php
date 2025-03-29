<?php

return [

    'styles' => [
        'navbar' => \App\Http\AdminlteCustomPresenter::class,
        'navbar-right' => \App\Http\AdminlteCustomPresenter::class,
        'nav-pills' =>\App\Http\AdminlteCustomPresenter::class,
        'nav-tab' => \App\Http\AdminlteCustomPresenter::class,
        'sidebar' => \App\Http\AdminlteCustomPresenter::class,
        'navmenu' => \App\Http\AdminlteCustomPresenter::class,
        'adminlte' => \App\Http\AdminlteCustomPresenter::class,
        'zurbmenu' => \App\Http\AdminlteCustomPresenter::class,
        'adminltecustom' => \App\Http\AdminlteCustomPresenter::class,
    ],

    'ordering' => true,

];