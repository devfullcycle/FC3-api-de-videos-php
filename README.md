<center>
  <p align="center">
    <img src="https://user-images.githubusercontent.com/20674439/158480514-a529b310-bc19-46a5-ac95-fddcfa4776ee.png" width="150"/>&nbsp;
    <img src="https://icon-library.com/images/php-icon/php-icon-8.jpg"  width="150" />
  </p>  
  <h1 align="center">🚀 Microserviço: API Catálogo de Vídeos com PHP/Laravel</h1>
  <p align="center">
    Microserviço API de Catálogo de Vídeos, com PHP <br />
    Projeto com TDD, Clean Arch, DDD e etc;
  </p>
</center>

### Como rodar?

Clone Repositório

```sh
git clone -b laravel-starter-kit https://github.com/devfullcycle/FC3-api-de-videos-php fc-app-laravel
```

```sh
cd fc-app-laravel
```

Crie o Arquivo .env

```sh
cp .env.example .env
```

Suba os containers do projeto

```sh
docker compose up -d
```

Acesse o container app

```sh
docker-compose exec app bash
```

Instale as dependências do projeto

```sh
composer install
```

Gere a key do projeto Laravel

```sh
php artisan key:generate
```

Acesse o projeto
[http://localhost:81](http://localhost:81)
