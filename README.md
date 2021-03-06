# Serverless faas OpenFass example

## Description

Mini project to learn OpenFaas, Faas and ServerLess.

## Stack

- Docker and Docker Swarm
- OpenFass
- C#
- PHP

## Install on Linux

Requirements:
- Docker and Docker swarm
- GIT

```bash
docker swarm init

git clone https://github.com/openfaas/faas.git
cd faas
git checkout 0.13.0
sh deploy_stack.sh
cd ../ && sudo rm -r ./faas

docker stack deploy func --compose-file docker-compose.yml
```

After execute command, you find in CLI your password and username to OpenFass.

**Example data:**
```
[Credentials]
    username: admin

    password: 547d9s578c23309bb1aa020e6395b6e7c0cc426d6a4707c513f

    echo -n 5473d0578s23309bb1aa020e6395b6e7c0cc42656d4707c513f | faas-cli login --username=admin --password-stdin
```
Install OpenFaas cli

```bash
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

## Pull template, build & deploy all function

```bash
cd ./src
make deploy
```

## Todo

- [x] C# Hello World
- [x] PHP7 example function
- [x] Own template to PHP7
- [x] Create and save to database user by PHP7
- [x] Makefile to deploy and build all function

## What I mistake

* Half-baked over engineering in Common/Config on users function

## Author

Łukasz Staniszewski < kontakt@lukaszstaniszewski.pl >

## License

Open GPL V3 or later