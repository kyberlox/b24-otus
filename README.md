# Установка Birtix24 с помощью Docker

## Структура проекта:

````
bitrix-docker/  
├── .env  
├── docker-compose.yml  
├── nginx/  
│   ├── Dockerfile  
│   └── nginx.conf  
├── php-fpm/  
│   ├── Dockerfile  
│   ├── php.ini  
│   ├── supervisor.conf  
│   └── www.conf  
├── mysql/  
│   └── my.cnf  
├── data/  
│   ├── mysql/  
│   ├── redis/  
│   └── bitrix/  
|       └── .settings.php  
└── logs/  
    ├── nginx/  
    ├── php/  
    ├── mysql/  
    └── supervisor/  
````
