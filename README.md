# Serverless faas OpenFass example

## Description

Soon

## Stack

- Docker and Docker Swarm
- OpenFass
- Rust
- C#
- PHP
- Python

## Install on Linux

Requirements:
- Docker and Docker swarm
- GIT

```bash
docker swarm init

git clone https://github.com/openfaas/faas \
  cd faas \
  git checkout 0.13.0 \
  ./deploy_stack.sh \
  cd ../ \
  sudo rm -R ./faas
 
curl -sL https://cli.openfaas.com | sudo sh
```

## Example deploy & build

Requirements:
- Faas CLI

```bash
cd ./src

faas-cli build -f hello-csharp.yml

faas-cli deploy -f hello-csharp.yml
```

Alternative method is add by web UI.

## Example web page

- OpenFaas portal: http://127.0.0.1:8080
- HelloCsharp function: http://127.0.0.1:8080/function/hello-csharp 

## Author

Łukasz Staniszewski < kontakt@lukaszstaniszewski.pl >

## License

Open GPL V3 or later