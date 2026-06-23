#!/bin/bash

echo "Atualizando pacotes..."
sudo apt update

echo "Instalando Docker, Docker Compose e Git..."
sudo apt install -y docker.io docker-compose git

echo "Habilitando Docker..."
sudo systemctl enable docker
sudo systemctl start docker

echo "Criando volume Jenkins..."
sudo docker volume create jenkins_home

echo "Subindo Jenkins..."
sudo docker run -d \
  --name jenkins \
  -p 9090:8080 \
  -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  jenkins/jenkins:lts

echo "Aguarde cerca de 30 segundos e acesse:"
echo "http://177.44.248.92:9090"

echo "Senha inicial:"
sudo docker exec jenkins cat /var/jenkins_home/secrets/initialAdminPassword