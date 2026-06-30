#!/bin/bash

echo "Criando ambiente de Homologação..."

sudo docker ps -a --format '{{.Names}}' | grep 'homolog-app' | xargs -r sudo docker rm -f
sudo docker ps -a --format '{{.Names}}' | grep 'homolog-db' | xargs -r sudo docker rm -f

sudo docker-compose -f docker-compose.homolog.yml -p homolog up -d --build

echo "Homologação disponível em:"
echo "http://177.44.248.92:8080/login.php"