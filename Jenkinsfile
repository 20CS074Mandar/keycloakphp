node {
  stage('SCM') {
    checkout scm
  }
  stage('SonarQube Analysis') {
    def scannerHome = tool 'SonarQubeScanner'
    withSonarQubeEnv() {
      sh "${scannerHome}/bin/sonar-scanner"
    }
  }
  stage('Docker Compose Down') {
    sh 'docker-compose down'
  }
  stage('Docker Compose Up') {
    sh 'docker-compose up -d'
  }
}