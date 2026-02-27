# Sistema de Gerenciamento de Transações

## 📋 Sobre o Projeto

Projeto desenvolvido referente ao Desafio PHP laravel.

## 🚀 Tecnologias e Dependências

### Backend (PHP)
- **PHP 8.2** ou superior
- **Laravel Framework 12** - Framework PHP principal
- **Laravel Breeze** - Sistema de autenticação simplificado

### Frontend
- **Bootstrap 5** - Freamwork frontend
- **Bootstrap Icons** - Biblioteca de ícones
- **Vite** - Build tool e servidor de desenvolvimento

### Ferramentas de Desenvolvimento
- **Pest PHP** - Framework de testes
- **Pest Plugin Laravel** - Integração do Pest com Laravel

## 🛠️ Funcionalidades

- ✅ **Autenticação completa** (registro, login, recuperação de senha)
- ✅ **Gerenciamento de perfil de usuário**
- ✅ **CRUD de transações financeiras**
- ✅ **Upload de documentos** organizados por data (ano/mês)
- ✅ **Interface responsiva** com Bootstrap Icons
- ✅ **Validação de formulários**

## 🚦 Como executar o projeto

### Pré-requisitos
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL/PostgreSQL/SQLite

### Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/filipe-csilva/Desafio-Financeiro.git
cd Desafio-Financeiro
```

2. **Instale as dependências**
```bash
composer install
npm install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
```

4. **Configure o banco de dados no arquivo .env**
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=
```

5. **Execute as migrações**
```bash
php artisan migrate
```

## 🏃 Executando a aplicação

Ambiente de desenvolvimento

```bash
composer run dev
```

Este comando inicia simultaneamente:

Servidor Laravel (php artisan serve)

Fila de processamento (php artisan queue:listen)

Servidor Vite para assets (npm run dev)


## 🔧 Configurações adicionais

Upload de documentos
Os documentos são armazenados em:

storage/app/public/documentos/YYYY/MM/ - Acessível publicamente

public/storage/documentos/YYYY/MM/ - Link simbólico para acesso web

Para criar o link simbólico:

```bash
php artisan storage:link
```

## 📝 Licença
Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](https://github.com/filipe-csilva/Desafio-Financeiro/blob/main/LICENSE) para mais detalhes.