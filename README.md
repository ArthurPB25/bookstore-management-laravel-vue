# Bookstore Management System 📚

Bem-vindo ao repositório do **Bookstore Management**, um sistema moderno para controle de estoque de livros e organização por categorias. Este projeto foi desenvolvido como resolução de um Desafio Técnico Full Stack.

## 🚀 Tecnologias Utilizadas
- **Backend:** PHP 8.2+ e Laravel 11
- **Frontend:** Vue.js 3 + Inertia.js
- **Estilização:** Tailwind CSS
- **Banco de Dados:** MySQL 8.0
- **Segurança (ACL):** Spatie Laravel-Permission
- **Infraestrutura:** Docker e Docker Compose

---

## ⚙️ Como executar o projeto

O ambiente foi totalmente dockerizado para facilitar a avaliação técnica. Não é necessário ter o PHP instalado localmente, apenas o Docker (e o Node/NPM para buildar os assets)!

### 1. Requisitos
- [Docker](https://www.docker.com/) e [Docker Compose](https://docs.docker.com/compose/)
- [Node.js](https://nodejs.org/en/) (somente para compilar o NPM do Vue)

### 2. Passo a passo de Instalação

Abra seu terminal na raiz do projeto e execute na ordem os comandos abaixo:

**1. Clone o repositório:**
```bash
git clone https://github.com/ArthurPB25/bookstore-management-laravel-vue.git
cd bookstore-management-laravel-vue
```

**2. Configure o ambiente (.env):**
Realize a cópia do arquivo de configuração:
```bash
cp .env.example .env
```
*(No Windows, você pode simplesmente copiar e colar o arquivo `.env.example` no mesmo diretório e renomear para `.env` se não estiver usando o Git Bash ou WSL).*

**3. Suba a infraestrutura do Docker:**
Isso inicializará a base de dados (MySQL) e o serviço que servirá o Laravel.
```bash
docker-compose up -d --build
```

**4. Instale as dependências de Backend:**
```bash
docker-compose exec app composer install
```

**5. Adicione a chave da aplicação Laravel:**
```bash
docker-compose exec app php artisan key:generate
```

**6. Crie as tabelas e popule o Banco de Dados:**
Este comando cria o schema completo e insere os usuários/permissões base.
```bash
docker-compose exec app php artisan migrate:fresh --seed
```

**7. Compile as dependências Visuais (Frontend):**
```bash
npm install
npm run build
```

✅ **Tudo pronto!**
Acesse o sistema no seu navegador: [http://localhost:8000](http://localhost:8000)

---

## 🔐 Credenciais de Acesso (Teste de ACL)

A aplicação conta com dois perfis diferentes configurados via Spatie Permissions. Você pode usar os logins abaixo para testar as restrições:

### 1. Administrador (Acesso Total)
Pode criar, atualizar e excluir qualquer livro.
- **E-mail:** `admin@livraria.com`
- **Senha:** `password`

### 2. Editor (Acesso Parcial)
Pode inserir e editar livros no sistema, mas os botões e recursos de Excluir estarão bloqueados e restritos tanto no Vue quanto no Backend.
- **E-mail:** `editor@livraria.com`
- **Senha:** `password`

---

## ✨ Principais Funcionalidades
- **SPA Experience:** Navegação reativa ultrarrápida (sem recarregamento de página) utilizando Inertia e Vue 3.
- **Controle de Acessos (Spatie):** Rotas Web, API e Componentes Vue protegidos por papéis (Roles).
- **CRUD e Validações:** Operações de banco perfeitas utilizando Eloquent, Request Validations e Paginação nativa.
- **Testes Nativos:** Cobertura de rotas sensíveis com testes automatizados do Pest/PHPUnit.