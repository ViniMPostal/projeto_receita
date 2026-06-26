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
                        sudo docker exec -i homolog-db psql -U postgres -d tabela_receita < ~/homolog/projeto_receita/database/003_add_observacao_receita.sql
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
                        sudo docker exec -i producao-db psql -U postgres -d tabela_receita < ~/producao/projeto_receita/database/003_add_observacao_receita.sql
                    "
                '''
            }
        }
    }
}