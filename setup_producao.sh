#!/bin/bash

echo "Criando ambiente de Produção..."

docker rm -f producao-app producao-db 2>/dev/null || true

sudo docker-compose -f docker-compose.producao.yml -p producao up -d --build

echo "Produção disponível em:"
echo "http://177.44.248.92:8081/login.php"