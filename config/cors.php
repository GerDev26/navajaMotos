<?php
return [
    'paths' => ['*'], // Permite todas las rutas
    'allowed_methods' => ['*'], // Permite todos los métodos (GET, POST, etc.)
    'allowed_origins' => ['*'], // Ajusta al dominio de tu front-end
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];

