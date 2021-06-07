# TESTE-UHC

### Detalhes

-   Aplicação com crud de Tasks, cadastro via SSO Google e Github

### Tecnologias

-   Laravel 8
-   Vue.JS 2.6

### Comandos Laravel

-- php artisan make:controller UserController
-- php artisan make:controller TaskController -r
-- php artisan make:model TaskModel
-- php artisan make:resource TaskCollection --collection
-- php artisan make:resource TaskResource
-- php artisan make:migration create_tasks
-- php artisan make:migrate

### Instalações npm

-   vue (^2.6.13),
-   vue-router (^3.5.1),
-   vuex ( ^3.6.)
-   @fortawesome/fontawesome-free (^5.15.3)
-   bootstrap (^5.0.1)
-   firebase (^8.6.5)

### Token (NNtoken)

é um Middleware de uso pessoal para controle de rotas com token, assim tenho o controle de rotas privadas, contendo métodos para gerar Token e recuperar informações adicionais também.

-   make: Gera o token JWT (adicionando id e email do usuario).
-   user: recupera o id e email adicionado ao token quando gerado.
