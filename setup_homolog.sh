#!/bin/bash

echo "Criando ambiente de Homologação..."

docker rm -f homolog-app homolog-db 2>/dev/null || true

docker-compose -f docker-compose.homolog.yml -p homolog up -d --build

echo "Homologação disponível em:"
echo "http://177.44.248.92:8080/login.php"