# Event Manager

O Event Manager é uma aplicação para criação e gerenciamento de eventos, onde os usuários podem se cadastrar, criar eventos e participar de eventos.

## Requisitos

- Docker
- Docker Compose
- PHP (para execução de comandos do Laravel)

Certifique-se de ter o Docker, Docker Compose e PHP instalados em sua máquina antes de prosseguir.

## Instalação e Execução com Docker e PHP

1. Clone este repositório para o seu ambiente de desenvolvimento:

    ```bash
    git clone https://github.com/vinisilvasn23/event-manager-PHP.git
    cd event-manager
    ```

2. Renomeie o arquivo `.env.example` para `.env` e ajuste as variáveis de ambiente conforme necessário.

3. Execute o comando Docker Compose para construir e iniciar os contêineres:

    ```bash
    docker-compose up -d --build
    ```

4. Instale as dependências do Laravel utilizando o Composer, dentro do contêiner do PHP:

    ```bash
    composer install
    ```

5. Gere a chave de aplicativo Laravel:

    ```bash
    docker-compose exec php php artisan key:generate
    ```

6. Execute as migrações do banco de dados dentro do contêiner do PHP:

    ```bash
    docker-compose exec php php artisan migrate
    ```

7. Acesse a aplicação em http://127.0.0.1/.

8. Para parar a execução da aplicação, execute:

## Uso

A aplicação consiste em três principais recursos:

- **Usuários**: Os usuários podem se cadastrar, fazer login e gerenciar seus perfis.
- **Eventos**: Os usuários podem criar, visualizar, editar e excluir eventos.
- **Participantes**: Os usuários podem se inscrever e visualizar outros participantes de eventos.

## Rotas Disponíveis

### Usuários

- **Criar Usuário**: `POST /api/users`
- **Obter Todos os Usuários**: `GET /api/users`
- **Atualizar Usuário**: `PATCH /api/users/{id}`
- **Excluir Usuário**: `DELETE /api/users/{id}`
- **Obter Usuário por ID**: `GET /api/users/{id}`

### Eventos

- **Criar Evento**: `POST /api/events`
- **Obter Todos os Eventos**: `GET /api/events`
- **Obter Evento por ID**: `GET /api/events/{id}`
- **Atualizar Evento**: `PATCH /api/events/{id}`
- **Excluir Evento**: `DELETE /api/events/{id}`
- **Inscrever Usuário em Evento**: `POST /api/events/{id}/enroll`
- **Obter Participantes do Evento**: `GET /api/events/{id}/participants`

### Autenticação

- **Login**: `POST /api/auth/login`
