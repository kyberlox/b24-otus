.settigs.php
<?php
return [
  'exception_handling' => [
      'value' => [
          'debug' => true, // Включить режим отладки
          'handled_errors_types' => E_ALL & ~E_NOTICE & ~E_SRICT, // Логировать все ошибки
          'exception_errors_types' => E_ALL, // Отображать все ошибки
          'log' => [
              'class_name' => 'Otus\\Diagnostic\\KyberloxLogs',
              'require_file' => 'OTUS/Diagnostic/KyberloxOtusLogs.php',
              'settings' => [
                  'file' => 'logs/exception.log', // Путь к лог-файлу
                  'log_size' => 1000000, // Размер лог-файла (1MB)
              ],
          ],
      ],
      'readonly' => false,
  ],

  'utf_mode' => [
      'value' => true,
      'readonly' => true,
  ],
  'cache_flags' => [
      'value' => [
          'config_options' => 3600,
          'site_domain' => 3600,
      ],
      'readonly' => false,
  ],
  'cookies' => [
      'value' => [
          'secure' => false,
          'http_only' => true,
      ],
      'readonly' => false,
  ],
  'connections' => [
    'value' => [
        'default' => [
            'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
            'host' => 'mysql',
            'database' => getenv('MYSQL_DATABASE'),
            'login' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
            'options' => 2,
        ]
    ],
    'readonly' => true,
  ],
  'session' => [
        'value' => [
            'mode' => 'default',
            'use_strict_mode' => 1,
            'use_cookies' => 1,
            'use_only_cookies' => 1,
            'cookie_secure' => 0, // Для HTTPS установите 1
            'timeout' => 86400, // Время жизни сессии (24 часа)
        ],
        'readonly' => false,
    ],
];
