<?php
return [
    'items' => [
        'authors' => [
            'title' => 'Авторлор',
            'icon'  => 'fa-users',
            'children' => [
                [
                    'title' => 'Админдер тизмеси',
                    'route' => 'admins',
                    'icon' => 'fa-address-book'
                ]
            ]
        ],
        'content' => [
            'title' => 'Мазмун',
            'icon'  => 'fa-indent',
            'children' => [
                [
                    'title' => 'Виджеттер',
                    'route' => 'admin_widgets',
                    'icon' => 'fa-toggle-on'
                ],
                [
                    'title' => 'Сүрөттөр',
                    'route' => 'admin_images',
                    'icon' => 'fa-file'
                ],
                [
                    'title' => 'Слайдер',
                    'route' => 'admin_slider',
                    'icon' => 'fa-film'
                ],
                [
                    'title' => 'Дареги',
                    'route' => 'admin_address',
                    'icon' => 'fa-map-marked-alt'
                ]
            ]
        ],
        'exercise' => [
            'title' => 'Көнүгүүлөр',
            'icon'  => 'fa-balance-scale',
            'children' => [
                [
                    'title' => 'Грамматика',
                    'route' => 'admin_grammar',
                    'icon' => 'fa-book'
                ],
                [
                    'title' => 'Көнүгүүлөр (GMR)',
                    'route' => 'admin_exercise',
                    'icon' => 'fa-bullseye'
                ],
                [
                    'title' => 'Тесттер',
                    'route' => 'admin_tests',
                    'icon' => 'fa-check-square'
                ],
                [
                    'title' => 'Видео',
                    'route' => 'admin_video',
                    'icon' => 'fa-film'
                ],
                [
                    'title' => 'Блог',
                    'route' => 'admin_blog',
                    'icon' => 'fa-rss'
                ]
            ]
        ],
        'categories' => [
            'title' => 'Категориялар',
            'icon'  => 'fa-server',
            'children' => [
                [
                    'title' => 'Жалпы бөлүмдөр',
                    'route' => 'admin_category',
                    'icon' => 'fa-angle-double-right'
                ],
                [
                    'title' => 'Көнүгүү бөлүмдөрү',
                    'route' => 'admin_exe_category',
                    'icon' => 'fa-angle-double-right'
                ]
            ]
        ]
    ],
];
