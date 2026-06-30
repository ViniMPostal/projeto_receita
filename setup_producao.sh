#!/bin/bash

echo "Criando ambiente de Produção..."

sudo docker ps -a --format '{{.Names}}' | grep 'producao-app' | xargs -r sudo docker rm -f
sudo docker ps -a --format '{{.Names}}' | grep 'producao-db' | xargs -r sudo docker rm -f 

sudo docker-compose -f docker-compose.producao.yml -p producao up -d --build

echo "Produção disponível em:"
echo "http://177.44.248.92:8081/login.php"