pipeline {

    agent any

    stages {

        stage('Clone') {
            steps {
                git branch: 'main', url: 'https://github.com/ViniMPostal/projeto_receita.git'
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

        stage('Qualidade de Código') {
            steps {
                sh '''
                    php vendor/bin/phpcs \
                    --ignore=vendor/*,tests/* \
                    .
                '''
            }
        }

        stage('Deploy Homologação') {
            steps {
                sh '''
                    ssh -o StrictHostKeyChecking=no univates@177.44.248.92 "
                        cd ~/homolog/projeto_receita &&
                        git fetch origin &&
                        git reset --hard origin/main &&
                        sudo docker ps -a --format '{{.Names}}' | grep 'homolog-app' | xargs -r sudo docker rm -f &&
                        sudo docker-compose -p homolog up -d --no-deps --build app
                    "
                '''
            }
        }

        stage('Aprovação Produção') {
            steps {
                input 'Homologação validada. Deseja publicar em Produção?'
            }
        }

        stage('Deploy Produção') {
            steps {
                sh '''
                    ssh -o StrictHostKeyChecking=no univates@177.44.248.92 "
                        cd ~/producao/projeto_receita &&
                        git fetch origin &&
                        git reset --hard origin/main &&
                        sudo docker ps -a --format '{{.Names}}' | grep 'producao-app' | xargs -r sudo docker rm -f &&
                        sudo docker-compose -p producao up -d --no-deps --build app
                    "
                '''
            }
        }
    }
}