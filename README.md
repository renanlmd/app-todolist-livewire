# App TodoList with Livewire

This project was developed with the intention of learning livewire
<img src="/public/screenshot.png"/>
### Prerequisites
<!--ts-->
   * Docker and docker-compose
  
<!--te-->

### Instalation
Choice your directory and clone the project
```shell
git clone https://github.com/renanlmd/app-todolist-livewire.git
```
Enter in directory of project and run the dependencies
```shell
composer install
cp .env.example .env
php artisan key:generate
```
Build the project
```shell
docker-compose up -d --build
```
Enter in container
```shell
docker exec -it TodoList_app bash
```
Run npm and snippets javascript inside container
```shell
npm install && npm run dev
```
Access in the browser
```shell
http://localhost:8000
```
--- 
<p align="center">Developed by: <a href="https://github.com/renanlmd">Renan Almeida</a></p> 
