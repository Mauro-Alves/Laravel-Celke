## Requisitos

* PHP 8.2 ou superior
* Composer

## Como rodar o projeto baixado

Duplicar o arquivo ".env.example" e renomear para ".env".<br>

Instalar as dependências do PHP
```
composer install
```

Gerar a chave
```
php artisan key:generate
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Acessar o conteúdo padrão do Laravel
```
http://127.0.0.1:8000
```

Criar migração
```
php artisan make:migration create_name_Table
```

Executar migration
```

php artisan migrate
```


## Sequencia para criar o projeto
Criar o projeto com Laravel
```
composer create-project laravel/laravel .
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Acessar o conteúdo padrão do Laravel
```
http://127.0.0.1:8000
```

## Como usar o GitHub
Baixar os arquivos do Git
```
git clone --branch <branch_name> <repository_url> .
```

Verificar a branch
```
git branch 
```

Baixar as atualizações
```
git pull
```

Criar View
```
php artisan make:view nome
```
php artisan make:view courses/show
```

