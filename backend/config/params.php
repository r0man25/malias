<?php
return [
    'adminEmail' => 'admin@example.com',
    'attrType' => [
        'string' => 'string',
        'integer' => 'integer',
        'date - YYYY-MM--DD' => 'date - YYYY-MM--DD',
    ],
    'attrTypePattern' => [
        'string' => '/^[a-z]+$/',
        'integer' => '/^[0-9]+$/',
        'date - YYYY-MM--DD' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',
    ],
];
