terraform {
  required_providers {
    docker = {
      source  = "kreuzwerker/docker"
      version = ">= 2.20.0"
    }
  }
}

provider "docker" {
  # Si estás usando Git Bash en Windows y falla, tendrás que exportar DOCKER_HOST:
  # export DOCKER_HOST="npipe:////./pipe/docker_engine"
}

resource "docker_image" "clinica_image" {
  name = "fernandogespindolao/proyecto-clinica:tf"
  build {
    context    = "../"      
    dockerfile = "Dockerfile"
  }
}

resource "docker_container" "clinica_container" {
  name  = "clinica_tf"
  image = docker_image.clinica_image.image_id

  ports {
    internal = 80
    external = 8080
  }

  restart = "unless-stopped"
}
