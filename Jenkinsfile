pipeline {
    agent any

    stages {
        stage('Clonar Repositorio') {
            steps {
                checkout scm
            }
        }

        stage('Build Docker') {
            steps {
                script {
                    dockerImage = docker.build("registro-alumnos:${env.BUILD_NUMBER}")
                }
            }
        }

        stage('Levantar Aplicación') {
            steps {
                sh 'docker-compose down || true'
                sh 'docker-compose up -d --build'
            }
        }
    }

    post {
        success {
            echo "✅ Despliegue exitoso"
        }
        failure {
            echo "❌ Falló el proceso"
        }
    }
}
