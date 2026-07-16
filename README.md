# To-Do List Full-Stack (Laravel & Vue.js/Quasar)

Um aplicativo de lista de tarefas completo (Full-Stack) focado em organização e produtividade. Este projeto foi desenvolvido separando a regra de negócio em uma API RESTful robusta e um front-end reativo e moderno.

## 🚀 Tecnologias Utilizadas

**Back-end (API)**
* PHP 8.3
* Laravel
* MySQL
* Composer

**Front-end (SPA)**
* JavaScript / Node.js
* Vue.js
* Quasar Framework

---

## ⚙️ Pré-requisitos

Antes de começar, você precisará ter as seguintes ferramentas instaladas em sua máquina:
* [Git](https://git-scm.com)
* [PHP](https://www.php.net/) (recomendado o uso do [Laragon](https://laragon.org/) para ambiente Windows)
* [Composer](https://getcomposer.org/) (com extensão ZIP habilitada no `php.ini`)
* [Node.js](https://nodejs.org/en/) (versão LTS)
* MySQL

---

## 📁 Clonando o Repositório

```bash
git clone https://github.com/Alysson-Lunardon/ToDo-com-api.git
```

---

## 🛠️ Instalação e Configuração

**1.Configurando o Back-end (Laravel)**  
Abra um terminal na pasta do back-end (todo-back) e execute os passos abaixo:  
1.1 Instale as dependências do PHP:  
```bash
composer install
```
1.2 Configure as Variáveis de Ambiente:  
Crie uma cópia do arquivo de configuração de exemplo:  
```bash
cp .env.example .env
```
Abra o arquivo .env gerado e configure as credenciais do seu banco de dados local:  
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```
1.3 Gere a Chave da Aplicação:  
(Nota: Certifique-se de que a pasta bootstrap/cache existe na raiz do back-end para evitar erros de permissão).
```bash
php artisan key:generate
```
1.4 Crie as Tabelas no Banco de Dados:  
```bash
php artisan migrate
```
1.5 Inicie o Servidor Local da API:  
```bash
php artisan serve
```
**2.Configurando o front-end(Vue/Quasar)**  
Abra um novo terminal na pasta do front-end (todo-front) e execute os passos abaixo:  
2.1 Instale o Quasar CLI Globalmente (necessário para rodar o ambiente de desenvolvimento):  
```bash
npm install -g @quasar/cli
```
2.2 Instale as dependências do projeto:  
```bash
npm install
```
2.3 Inicie o Servidor Front-end:  
```bash
npm run dev
```
A aplicação abrirá automaticamente no seu navegador, geralmente em http://localhost:9000.

---  

<img width="1904" height="942" alt="Captura de tela 2026-07-16 010735" src="https://github.com/user-attachments/assets/fc3149d4-7c2b-49aa-8d3c-435841b63b66" />

---

🔒 Segurança  
O projeto utiliza práticas recomendadas de separação de responsabilidades (Front e Back) e omissão de arquivos sensíveis via .gitignore (como chaves de aplicação, variáveis de ambiente .env e pastas temporárias bootstrap/cache), visando a integridade e segurança do ambiente de desenvolvimento.  

Feito com dedicação por **Alysson Lunardon**.
