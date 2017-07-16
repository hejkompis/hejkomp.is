<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/public/user/config/site.yaml',
    'modified' => 1500047079,
    'data' => [
        'title' => 'Hej kompis!',
        'default_lang' => 'en',
        'logo' => 'hejkompis-logo.png',
        'author' => [
            'name' => 'Per Olsson',
            'email' => 'per@grafikprofil.se'
        ],
        'taxonomies' => [
            0 => 'category',
            1 => 'tag'
        ],
        'metadata' => [
            'description' => 'Grav is an easy to use, yet powerful, open source flat-file CMS'
        ],
        'summary' => [
            'enabled' => true,
            'format' => 'short',
            'size' => 300,
            'delimiter' => '==='
        ],
        'blog' => [
            'route' => '/blog'
        ]
    ]
];
