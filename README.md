# LibreFly: Teste Situacional Backend v2

## Dependencias
- Docker
- Docker compose

## Quick Start

```shell
./vendor/bin/sail up -d
./vendor/bin/sail artisan jwt:secret
./vendor/bin/sail artisan l5-swagger:generate
./vendor/bin/sail artisan migrate:fresh
./vendor/bin/sail artisan db:seed
```

## Usuario de teste padrão
POST localhost/api/auth
```json
{
  "email":"test@example.com",
  "password":"password"
}
```
## Documentação Swagger
http://localhost/api/documentation

## Testes Unitários
TODO