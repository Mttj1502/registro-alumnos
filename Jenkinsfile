pipeline {
    agent any

    environment {
        DEPLOY_DIR = "C:/servidor/registro-alumnos"
        PHP_PATH = "php"
    }

    stages {

        stage('Build') {
            steps {
                echo '📦 Clonando repositorio y verificando PHP...'
                git branch: 'main', url: 'https://github.com/Mttj1502/registro-alumnos.git'
                bat "${PHP_PATH} -v"
            }
        }

        stage('Test') {
            steps {
                echo '🧪 Verificando sintaxis PHP...'
                bat 'for /R %f in (*.php) do php -l "%f"'
                echo '✅ Todos los archivos PHP tienen sintaxis válida.'
            }
        }

        stage('Deploy') {
            steps {
                echo '🚀 Desplegando app...'

                // Detener servidor PHP embebido si existe
                bat 'taskkill /F /IM php.exe || exit 0'

                // Limpiar y copiar archivos al directorio de despliegue
                bat "rmdir /S /Q %DEPLOY_DIR%"
                bat "mkdir %DEPLOY_DIR%"
                bat "xcopy /E /I /Y * %DEPLOY_DIR%"

                // Levantar el servidor embebido en localhost:8000
                bat "start ${PHP_PATH} -S localhost:8000 -t %DEPLOY_DIR%"
                echo '✅ Aplicación levantada en http://localhost:8000'
            }
        }
    }

    post {
        success {
            echo '🎉 CI/CD completado con éxito.'
        }
        failure {
            echo '❌ Algo falló en el pipeline.'
        }
    }
}
