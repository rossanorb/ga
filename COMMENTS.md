# Aplicação separada em duas pastas:

    - Api

        -- Desenvolvida em PHP utilizando Framework Laravel 5.7

        -- Aplição estará disponível na seguinte url :   http://localhost:9001/

        -- Para testes de Api podem ser usados o seguinte endpoints:

            --- POST http://localhost:9001/api/students
            --- GET http://localhost:9001/api/students?order&by=asc&like&limit&page=1
            --- GET http://localhost:9001/api/students/1
            --- PUT http://localhost:9001/api/students/1
            --- DELETE http://localhost:9001/api/students/1

    - app

        -- Aplicação SPA desenvolvida em Vue.js

        -- Aplição estará disponível na seguinte url:   http://localhost:3000/


# Aplicação está em containers no Docker

    - É necessário ter o Docker e docker-compose instalados

        -- Para iniciar o docker entre na raiz do projeto e digite no terminal :

# Procedimentos para executar a aplicação

1) Na raiz do projeto execute o seguinte comando no terminal:

    docker-compose up

2) Ao finalizar o processo de subir os containers devem ser exibidos 4 containers

    app, nginx, api e mysql. Para verificar se os containers estão rodando execute no terminal:

    docker ps

3) Dar permissão de escrita nas pastas :

    api/storage

    api/bootstrap

    api/public

4) Acessar container ga_api, digite no terminal:

    docker exec -it ga_api bash

5) Ao entrar no prompt do container api dentro do docker, execute o seguinte comando para instalar dependências do Laravel

    composer install

6) Terminada a instalação das dependências, execute o migration com o seguinte comando abaixo que irá criar as tabelas no banco:

    php artisan migrate

A seguinte mensagem deve exibir:

    Migrating: 2014_10_12_000000_create_users_table
    Migrated:  2014_10_12_000000_create_users_table
    Migrating: 2014_10_12_100000_create_password_resets_table
    Migrated:  2014_10_12_100000_create_password_resets_table
    Migrating: 2020_06_20_133423_create_students_table
    Migrated:  2020_06_20_133423_create_students_table

7) Se às tabelas forem criadas com sucesso, já é possível executar testes unitários, para isso execute ainda dentro do container "api" o seguinte comando:

    ./vendor/bin/phpunit --debug --verbose --color

    ou

    sudo docker exec ga-api ./vendor/bin/phpunit --debug --verbose --color

A seguinte mensagem deve exibir:

    Runtime:       PHP 7.3.6
    Configuration: /var/www/phpunit.xml

    Test 'Tests\Unit\StudentTest::testCreateStudent' started
    Test 'Tests\Unit\StudentTest::testCreateStudent' ended
    Test 'Tests\Unit\StudentTest::testValidationStudent' started
    Test 'Tests\Unit\StudentTest::testValidationStudent' ended
    Test 'Tests\Unit\StudentTest::testUpdateStudent' started
    Test 'Tests\Unit\StudentTest::testUpdateStudent' ended
    Test 'Tests\Unit\StudentTest::testDeleteStutend' started
    Test 'Tests\Unit\StudentTest::testDeleteStutend' ended
    Test 'Tests\Feature\ExampleTest::testBasicTest' started
    Test 'Tests\Feature\ExampleTest::testBasicTest' ended


8) A aplicação pode ser acessada pelo seguinte endereço:

    http://localhost:3000/



