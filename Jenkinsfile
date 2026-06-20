pipeline {

    agent any

    stages {

        stage('Clone') {
            steps {
                git branch: 'main',
                    url: 'https://github.com/ViniMPostal/projeto_receita.git'
            }
        }

        stage('Instalar Dependências') {
            steps {
                sh 'composer install'
            }
        }

        stage('Executar Testes') {
            steps {
                sh '''
                    chmod +x vendor/bin/phpunit
                    php vendor/bin/phpunit tests
                '''
            }
        }

        stage('Deploy Homologação') {
            steps {
                sh '''
                    ssh -o StrictHostKeyChecking=no univates@177.44.248.92 "
                        cd ~/homolog/projeto_receita &&
                        git pull origin main &&
                        sudo docker ps -a --format '{{.Names}}' | grep 'homolog-app' | xargs -r sudo docker rm -f &&
                        sudo docker-compose -p homolog up -d --no-deps --build app
                    "
                '''
            }
        }

    }
}