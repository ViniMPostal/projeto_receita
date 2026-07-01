pipeline {

    agent any

    parameters {
        choice(
            name: 'AMBIENTE',
            choices: ['homologacao', 'producao', 'todos'],
            description: 'Escolha qual ambiente deseja criar ou atualizar'
        )
    }

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
                    . || true
                '''
            }
        }

        stage('Preparar VM') {
            steps {
                sh '''
                    ssh -o StrictHostKeyChecking=no univates@177.44.248.92 "
                        sudo apt update &&
                        sudo apt install -y docker.io docker-compose git &&
                        sudo systemctl enable docker &&
                        sudo systemctl start docker
                    "
                '''
            }
        }

        stage('Criar Homologação') {
            when {
                expression {
                    params.AMBIENTE == 'homologacao' || params.AMBIENTE == 'todos'
                }
            }
            steps {
                sh '''
                    ssh -o StrictHostKeyChecking=no univates@177.44.248.92 "
                        rm -rf ~/projeto_receita ~/homolog &&
                        git clone https://github.com/ViniMPostal/projeto_receita.git ~/projeto_receita &&
                        mkdir -p ~/homolog &&
                        cp -r ~/projeto_receita ~/homolog/ &&
                        cd ~/homolog/projeto_receita &&
                        chmod +x setup_homolog.sh &&
                        ./setup_homolog.sh &&
                        until sudo docker exec homolog-db pg_isready -U postgres -d tabela_receita; do
                            echo "Aguardando PostgreSQL da homologação iniciar..."
                            sleep 2
                        done &&
                        cat database/003_create_auditoria_receita.sql | sudo docker exec -i homolog-db psql -U postgres -d tabela_receita
                    "
                '''
            }
        }

        stage('Criar Produção') {
            when {
                expression {
                    params.AMBIENTE == 'producao' || params.AMBIENTE == 'todos'
                }
            }
            steps {
                sh '''
                    ssh -o StrictHostKeyChecking=no univates@177.44.248.92 "
                        rm -rf ~/projeto_receita ~/producao &&
                        git clone https://github.com/ViniMPostal/projeto_receita.git ~/projeto_receita &&
                        mkdir -p ~/producao &&
                        cp -r ~/projeto_receita ~/producao/ &&
                        cd ~/producao/projeto_receita &&
                        chmod +x setup_producao.sh &&
                        ./setup_producao.sh &&
                        until sudo docker exec producao-db pg_isready -U postgres -d tabela_receita; do
                            echo "Aguardando PostgreSQL da produção iniciar..."
                            sleep 2
                        done &&
                        cat database/003_create_auditoria_receita.sql | sudo docker exec -i producao-db psql -U postgres -d tabela_receita 
                    "
                '''
            }
        }
    }
}