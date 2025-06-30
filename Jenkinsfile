pipeline {
    agent any

    environment {
        PHP_PATH = 'C:\\php\\php.exe'
        SERVIDOR_DIR = 'C:\\servidor\\registro-alumnos'
        REPO_DIR = "${env.WORKSPACE}"
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
                bat '''
                for /R %%f in (*.php) do C:\\php\\php.exe -l "%%f"
                '''
                echo '✅ Todos los archivos PHP tienen sintaxis válida.'
            }
        }

        stage('Deploy') {
            steps {
                echo '🚀 Desplegando app...'

                // Cierra instancias anteriores si existen (ignora error si no existe)
                bat 'taskkill /F /IM php.exe || exit 0'

                // Limpia y crea el nuevo directorio de despliegue
                bat 'rmdir /S /Q "%SERVIDOR_DIR%" || exit 0'
                bat 'mkdir "%SERVIDOR_DIR%"'

                // Copia todos los archivos al nuevo directorio
                bat 'xcopy /E /I /Y * "%SERVIDOR_DIR%"'

                // Inicia el servidor PHP usando la carpeta "public" como raíz
                bat 'start "PHP Server" %PHP_PATH% -S localhost:8000 -t "%SERVIDOR_DIR%\\public"'
            }
        }
    }

    post {
        success {
            echo '✅ CI/CD ejecutado correctamente. App desplegada en http://localhost:8000'
        }
        failure {
            echo '❌ Algo falló en el pipeline.'
        }
    }
}


