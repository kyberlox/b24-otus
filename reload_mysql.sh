#!/bin/bash
docker-compose down mysql
docker-compose up -d --build mysql
chmod -R 777 ./
