# Coopersystem Ads Wordpress
### Proposta

Resolução do desafio proposto pela Coopersystem

O projeto consiste em uma funcionalidade desenvolvida para WordPress que gerencie anuncios.

## Aplicação

A aplicação foi desenvolvida em Wordpress tendo como banco de dados o MySQL.

## Pré-requisitos para o setup:

- Docker
- Docker-compose
- Apenas se estiver usando Windows: Bash Shell (Cmder ou Git Bash)

### Instalação
1. Clone o repositório para o seu ambiente de desenvolvimento.

git clone https://github.com/pedroholiveira1998/ads-wordpress.git


2. Vá ao diretório raiz do projeto e execute o comando para subir os containers e instalar as dependências

sudo docker-compose up --build


### Acessos:
URL da aplicação

http://localhost:8000

URL do phpMyAdmin

http://localhost:8080

Usuario para acesso phpMyAdmin:

wordpress

Senha para acesso phpMyAdmin:

wordpress



### Configurações

1. Abra o URL da aplicação e selecione a linguagem desejada.

2. Preencha os campos e instale o Wordpress.

3. Logue com as credencias que cadastrou e no menu lateral esquerdo clique em Plugins.

4. Ative o plugin Coopersystem ads challenger.

5. Desative extensões de bloqueadores de anuncios. (algumas extensões bloqueam o uso de palavras como ads, anuncio, etc...)

*Obs:* No momento da ativação se cria a tabela wp_ads no banco de dados. 

### Usabilidade

Ao ativar o Plugin no menu lateral esquerdo selecione o ícone referente a ele, nesse momento você será redirecionado para a tela que possibilita fazer Cadastro de um anuncio, alterar o anuncio, deletar um anuncio e listar anuncios. Na lista será visivel ao administrador todas as informações referentes ao anuncio, incluindo a data de criação e o criador do anuncio e a data de atualização e quem fez a ultima atualização.<br /><br />
Na tela principal do site será listados os anuncios sendo possível aplicar alguns filtros. 
- Buscar por parte do nome, tag.
- Ordenar por data de criação.

# Docker
Relação de comandos mais usados no docker

### Lista containers em execução
    docker ps

### Acessar o container
    docker exec -it NOMEDOCONTAINER bash

### Caso algo de errado, você pode forçar a recriação dos containers com o comando:
    docker-compose up --force-recreate

### Parar todos os containers
    docker stop $(docker ps -a -q)

### Liberar espaço em disco 
    docker volume prune

### Remover images/containers
    docker-compose rm #remove containers criados pelo docker-compose
    docker rm $(docker ps -a -q) #remove todos os containers
    docker rmi $(docker images -q -a) #remove todas as imagens

### Listar imagens
    docker images

### Listar redes
    docker network ls

## Referências

WordPress

* [WordPress](https://codex.wordpress.org/pt-br:P%C3%A1gina_Inicial)

PHP

* [PHP](http://php.net/docs.php)
* [PHP do jeito certo](http://br.phptherightway.com/)

CSS

* [CSS](https://developer.mozilla.org/en-US/docs/Learn/CSS)
* [CSS Tricks](https://css-tricks.com/)

Docker

* [Docker](https://docs.docker.com/get-started/overview/)

GIT

* [GIT Reference](https://git-scm.com/docs/)
* [Fluxo de trabalho de Gitflow](https://www.atlassian.com/br/git/tutorials/comparing-workflows/gitflow-workflow)