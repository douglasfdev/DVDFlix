# Rent a DVD

Este projeto é destinado a aplicação para alugueis de DVD.

## Configurando ambiente de desenvolvimento
# Copie e edite(opcional) o arquivo .env
*`cp env.example .env`*

# Install docker & docker-compose
https://docs.docker.com/engine/install/

https://docs.docker.com/compose/install/

# Adicionar permissões para o docker
```
sudo usermod -aG docker ${USER}
sudo su - ${USER}
```

# Rodar o docker-compose
*`docker-compose up -d`*

# Rodar o composer
*`docker-compose exec app composer install`*

# Rodar as migrations com as seeds
*`docker-compose exec app php artisan migrate:fresh --seed`*

### Servidor
Não é necessário executar o comando *`php artisan serve`*, servidor já está com Nginx para expormos a API como serviço web

--------

# Para ambiente local basta ter o PHP na versão 8.3 ou acima

# Rodar o composer
*`composer install`*

# Rodar as migrations com as seeds
*`php artisan migrate:fresh --seed`*

# Rodar o projeto
*`php artisan serve`*