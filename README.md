Quadro Societário APP

Este é um sistema desenvolvido para facilitar o cadastro de empresas e gerenciar seu quadro societário. Ele permite o registro de informações detalhadas sobre empresas e seus sócios.

Requisitos

- PHP 8.2.12
- XAMPP 3.3
- PostgreSQL 16.2

Configuração do PostgreSQL

1. Descomente a linha referente a `DATABASE_URL` no arquivo `.env`.
2. Realize a alteração do usuário e senha. No meu cenário, ficou assim:

    DATABASE_URL="postgresql://postgres:postgres@127.0.0.1:5432/quadro_societario?serverVersion=16&charset=utf8"

3. Após configurar o banco de dados, abra um terminal na pasta do projeto e execute os seguintes comandos:

    bash
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate
  

Iniciando o Servidor

Após configurar o banco de dados, inicie o servidor com o comando:

bash
symfony server:start

O caminho para iniciar a aplicação é http://127.0.0.1:8000/login

Primeiro Acesso
Para o primeiro acesso, é necessário realizar um cadastro.

Acessando a Aplicação
Após realizar o cadastro, você será redirecionado para a tela de login novamente e poderá acessar a aplicação.

Funcionalidades
-A aplicação abrirá na listagem de empresas. No primeiro acesso, será necessário cadastrar uma empresa.
-No menu acima, temos a aba de sócios, onde é possível verificar a listagem de sócios e cadastrar sócios vinculando-os a empresas.
-Todos os cadastros já salvam os dados no banco de dados.
-Na barra de menu, ainda é possível visualizar o usuário logado e realizar o logout.

Agradeço novamente pela oportunidade e estou ansioso para colaborar com você e sua equipe no futuro!
