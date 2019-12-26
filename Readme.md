# Subindo o ambiente com Docker

Altere o arquivo config.php de (localhost:3306 para mysql:3306)

```bash
docker-compose up
```

Para verificar o ambiente em docker, acessar:  http://localhost/info.php


## Acessando container
```bash
docker-compose exec php bash
```
