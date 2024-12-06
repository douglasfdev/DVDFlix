# Rent a DVD

Este projeto é destinado a aplicação para alugueis de DVD.

## Configurando ambiente de desenvolvimento

## Copie e edite(opcional) o arquivo .env
Linux: *`cp env.example .env`*
Windows: *`Copy-Item .\.env.example .\.env`*

## Install docker & docker-compose
https://docs.docker.com/engine/install/

https://docs.docker.com/compose/install/

## Adicionar permissões para o docker
```
sudo usermod -aG docker ${USER}
sudo su - ${USER}
```

## Rodar o docker-compose
*`docker-compose up -d`*

## Rodar comando git dentro do container para ele considerar um repositório seguro
*`docker-compose exec app git config --global --add safe.directory /var/www`*

## Rodar o composer
*`docker-compose exec app composer install`*

## Gerar uma secret key
*`docker-compose exec app php artisan key:generate`*

## Rodar as migrations com as seeds
*`docker-compose exec app php artisan migrate:fresh --seed`*

### Servidor
Não é necessário executar o comando *`php artisan serve`*, servidor já está com Nginx para expormos a API como serviço web
Serviço estará rodando na URL local: *`http://localhost:8989/`*

--------

# Para ambiente local basta ter o PHP na versão 8.3 ou acima

## Rodar o composer
*`composer install`*

## Rodar as migrations com as seeds
*`php artisan migrate:fresh --seed`*

## Rodar o projeto
*`php artisan serve`*
