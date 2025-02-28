<?php

return [
    [
        'title' => 'Main',
        'can' => 'dashbord.index'
    ],
    [
        'icon' => '<i class="ri-dashboard-3-fill"></i>',
        'title' => 'Dashboard',
        'route' => 'home',
        'can' => 'dashbord.index'
    ],
    [
        'icon' => '<i class="fas fa-home"></i>',
        'title' => 'About',
        'route' => 'about.edit',
        'can' => 'about.edit'
    ],
    [
        'icon' => '<i class="fas fa-th-list"></i>',
        'title' => 'Category',
        'route' => 'category.index',
        'can' => 'category.index'
    ],
    [
        'icon' => '<i class="fas fa-question-circle"></i>',
        'title' => 'Quiz',
        'route' => 'quiz.index',
        'can' => 'quiz.index'
    ],
    [
        'icon' => '<i class="fas fa-palette"></i>',
        'title' => 'Colourings',
        'route' => 'colouring.index',
        'can' => 'colouring.index'
    ],
    [
        'icon' => '<i class="fas fa-question"></i>',
        'title' => 'Why questions',
        'route' => 'whyquestion.index',
        'can' => 'whyquestion.index'
    ],
    [
        'icon' => '<i class="fas fa-clone"></i>',
        'title' => 'Find the difference',
        'route' => 'difference.index',
        'can' => 'difference.index'
    ],

    [
        'icon' => '<i class="fas fa-commenting"></i>',
        'title' => 'Fairy Tales',
        'route' => 'tale.index',
        'can' => 'tale.index'
    ],

    [
        'icon' => '<i class="fas fa-chess-king"></i>',
        'title' => 'Games',
        'route' => 'game.index',
        'can' => 'game.index'
    ],
    [
        'icon' => '<i class="fas fa-palette"></i>',
        'title' => 'Arts and Crafts',
        'route' => 'arts_and_crafts.index',
        'can' => 'arts_and_crafts.index'
    ],
    [
        'icon' => '<i class="fas fa-mail-bulk"></i>',
        'title' => 'Contact Us',
        'route' => 'contact.index',
        'can' => 'contact.index'
    ],
    [
        'icon' => '<i class="far fa-file"></i>',
        'title' => 'Privacy and Policy',
        'route' => 'privacyandpolicy.edit',
        'can' => 'privacyandpolicy.edit'
    ],
    [
        'icon' => '<i class="far fa-file"></i>',
        'title' => 'Terms and Conditions',
        'route' => 'termsandcondition.edit',
        'can' => 'termsandcondition.edit'
    ],
];
