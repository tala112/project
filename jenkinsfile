pipeline {
    agent any
    environment {
        GIT_REPO = 'https://github.com/tala112/project.git'   // رابط المستودع البعيد
        LOCAL_DIR = 'Project/lamp/project_files'               // المسار المحلي للملفات
        LAMP_IMAGE = 'lamp_image'                              // اسم صورة الـ Docker
        DOCKERFILE_DIR = 'Project/lamp'                        // المسار الذي يحتوي على الـ Dockerfile
    }
    stages {
        stage('Check for Changes') {
            steps {
                script {
                    // استنساخ المستودع البعيد إلى مجلد مؤقت
                    dir('temp_repo') {
                        git url: GIT_REPO, branch: 'main'
                    }
                    
                    // مقارنة الملفات بين المستودع البعيد (temp_repo) والمجلد المحلي (project_files)
                    def changes = sh(script: "diff -r temp_repo ${LOCAL_DIR}", returnStatus: true)
                    
                    // إذا كانت هناك تغييرات، نعيد بناء الحاوية
                    if (changes == 0) {
                        echo 'لا توجد تغييرات بين المستودع المحلي والمستودع البعيد'
                    } else {
                        echo 'تم العثور على تغييرات. بناء الحاوية الثانية مع المستودع البعيد...'
                        buildContainer()
                    }
                }
            }
        }
    }
}

def buildContainer() {
    // بناء الحاوية باستخدام الـ Dockerfile من المسار المحدد
    sh """
        docker-compose -f docker-compose.yml build --no-cache --build-arg LOCAL_DIR=${LOCAL_DIR} ${DOCKERFILE_DIR}
        docker-compose up -d
    """
}
