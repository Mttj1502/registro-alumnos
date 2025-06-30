pipeline {
    agent any

    environment {
        PHP_PATH = 'C:\\php\\php.exe'
        DEPLOY_DIR = "C:\\servidor\\registro-alumnos"
    }

    stages {
        stage('Build') {
            steps {
                echo '📦 Clonando repositorio y verificando PHP...'
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

                // Intentamos cerrar procesos php.exe (si están corriendo)
                bat 'taskkill /F /IM php.exe || exit 0'

                // Eliminar el directorio de despliegue anterior si existe
                bat 'rmdir /S /Q "%DEPLOY_DIR%"'

                // Crear la nueva carpeta de despliegue
                bat 'mkdir "%DEPLOY_DIR%"'

                // Copiar todos los archivos del repositorio a la carpeta de despliegue
                bat 'xcopy /E /I /Y * "%DEPLOY_DIR%"'

                // Iniciar servidor embebido PHP apuntando a la carpeta deploy
                bat "start \"PHP Server\" ${PHP_PATH} -S localhost:8000 -t \"%DEPLOY_DIR%\""
            }
        }
    }

    post {
        failure {
            echo '❌ Algo falló en el pipeline.'
        }
        success {
            echo '✅ CI/CD ejecutado correctamente. App desplegada en http://localhost:8000'
        }
    }
}


