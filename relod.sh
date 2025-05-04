#!/bin/bash
docker-compose down
docker-compose up -d --build
chmod -R 777 ./