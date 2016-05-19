<?php
return [
    [
        'menu' => trans('domain.content::nav.Command Management'),
        'icon' => "fa fa-table",
        'href' => "#",
        'sub-menu' => [
            [
                'title' => trans('domain.content::nav.Add New Command'),
                'href'  => route('content.telegram.create'),
            ],
            [
                'title' => trans('domain.content::nav.Command List'),
                'href'  => route('content.telegram.index'),
            ]
        ]
    ],
    [
        'menu' => trans('domain.content::nav.Preferences'),
        'icon' => "fa fa-table",
        'href' => "#",
        'sub-menu' => [
            [
                'title' => trans('domain.content::nav.About Robot'),
                'href'  => route('content.preferences.create'),
            ],
        ]
    ],

];