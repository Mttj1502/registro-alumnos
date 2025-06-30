pipeline {
    agent any

    environment {
        DEPLOY_DIR = "C:/servidor/registro-alumnos"
        PHP_PATH = "C:/php/php.exe"
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
        bat 'for /R %%f in (*.php) do C:\\php\\php.exe -l "%%f"'
        echo '✅ Todos los archivos PHP tienen sintaxis válida.'
    }
}


        stage('Deploy') {
            steps {
                echo '🚀 Desplegando app...'

                // Detiene instancias anteriores del servidor PHP si las hay
                bat 'taskkill /F /IM php.exe || exit 0'

                // Limpia la carpeta de despliegue
                bat "rmdir /S /Q %DEPLOY_DIR%"
                bat "mkdir %DEPLOY_DIR%"

                // Copia el código actualizado
                bat "xcopy /E /I /Y * %DEPLOY_DIR%"

                // Inicia el servidor embebido de PHP
                bat "start \"PHP Server\" ${PHP_PATH} -S localhost:8000 -t %DEPLOY_DIR%"
                echo '✅ Aplicación disponible en http://localhost:8000'
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

