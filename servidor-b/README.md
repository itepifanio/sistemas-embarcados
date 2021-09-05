### Servidor B

É um módulo web que recebe informações da fila semi-processadas do servidor A. Escrito em PHP com o framework Laravel.

### Instalando

Para utilizar o sistema você deverá ter instalado em sua máquina o PHP em sua versão 8; o gerenciador de 
dependências, composer, em sua versão 2; o npm na sua versão 7+; o MySQL instalado.

- Cópie o .env.example para o arquivo .env ` cp .env.example .env `
- Gere a chave da sua aplicação ` php artisan key:generate `
- Modifique o arquivo .env para conter as suas informações de banco de dados
- Faça a migração dos dados ` php artisan migrate:fresh --seed `
- Instale e compile o javascript ` npm install && npm run dev `
- Rode o servidor local da aplicação ` php artisan serve `
