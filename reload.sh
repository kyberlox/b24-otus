#!/bin/bash
docker-compose down
chmod -R 777 ./
docker-compose up -d --build