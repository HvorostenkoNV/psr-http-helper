#!/bin/bash

cd docker
docker compose down
docker compose up -d
docker exec -it psr-http-helper-php sh
