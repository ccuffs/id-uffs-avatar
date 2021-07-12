<p align="center">
    <img width="400" src=".github/logo.png" title="Logo do projeto"><br />
    <img src="https://img.shields.io/maintenance/yes/2021?style=for-the-badge" title="Status do projeto">
    <img src="https://img.shields.io/github/workflow/status/ccuffs/id-uffs-avatar/ci.uffs.cc?label=Build&logo=github&logoColor=white&style=for-the-badge" title="Status do build">
</p>

# id-uffs-avatar

Micro-serviço web para mostrar imagens de perfil a partir do idUFFS de um usuário da [Universidade Federal da Fronteira Sul](https://www.uffs.edu.br). A ideia é ter o mínimo de atrito (e esforço) para mostrar uma imagem de avatar de um usuário que possua um idUFFS, ao estilo do serviço [Gravatar](https://gravatar.com).

## ✨ Uso do serviço

Se você está construindo um serviço web para a UFFS e gostaria de mostrar o avatar de um usuário que tenha um idUFFS, basta criar uma imagem da seguinte forma:

```html
<img src="https://cc.uffs.edu.br/avatar/iduffs/{iduffs}" title="Avatar" />
```

onde `{iduffs}` deve ser substituído pelo idUFFS do usuário em questão. Por exemplo, para o usuário cujo idUFFS é `fernando.bevilacqua`, a URL do avatar é:

```html
<img src="https://cc.uffs.edu.br/avatar/iduffs/fernando.bevilacqua" title="avatar" />
```

> *DICA*: se estiver usando [Tailwind](https://tailwindcss.com), use o seguinte: `<img class="h-12 w-12 object-cover rounded-full" src="https://cc.uffs.edu.br/avatar/iduffs/{iduffs}" title="avatar" />`.


Usuários do seu serviço podem acessar [cc.uffs.edu.br/avatar](https://cc.uffs.edu.br/avatar) para conferir sua imagem de perfil ativa.

## 🚀 Desenvolvimento 

Se você planeja trabalhar para evoluir essa ferramenta, siga as intruções abaixo. Você precisará do seguinte já instalado:

- [PHP](https://www.php.net/downloads);
- [Composer](https://getcomposer.org/download/);
- [Node e NPM](https://nodejs.org/en/);

### 1. Clonando o repositório

```
git clone https://github.com/ccuffs/id-uffs-avatar && cd id-uffs-avatar
```

### 2. Configuração do Laravel

Crie um arquivo chamado `.env` utilizando `.env.example` como template:

```
cp .env.example .env
```

> Se você seguir os passos aqui descritos e a aplicação não rodar como esperado, deixe o campo `APP_URL` vazio no `.env`. 

O valor do campo `DB_CONNECTION` já estará configurado para `sqlite`, o que fará a aplicação utiliar um banco local SQLite no caminho  `/database/database.sqlite`. 

Agora, instale as dependências do PHP:

```
composer install
```

Após, uma chave da aplicação deve ser gerada:

```
php artisan key:generate
```

Por fim, rode as migrações, para carregar as relações no banco:

```
php artisan migrate
```

Se houver seeders para o banco de dados, rode:

```
php artisan db:seed
```

### 3. Configuração do Node

Para o front-end, basta instalar as dependências com o `npm`:

```
npm install
```

### 4. Rodando o Projeto

Inicie o servidor Laravel

```
php artisan serve
```

E compile o front-end:

```
npm run dev
```

## 🤝 Contribua

Sua ajuda é muito bem-vinda, independente da forma! Confira o arquivo [CONTRIBUTING.md](CONTRIBUTING.md) para conhecer todas as formas de contribuir com o projeto. Por exemplo, [sugerir uma nova funcionalidade](https://github.com/ccuffs/id-uffs-avatar/issues/new?assignees=&labels=&template=feature_request.md&title=), [reportar um problema/bug](https://github.com/ccuffs/id-uffs-avatar/issues/new?assignees=&labels=bug&template=bug_report.md&title=), [enviar um pull request](https://github.com/ccuffs/hacktoberfest/blob/master/docs/tutorial-pull-request.md), ou simplemente utilizar o projeto e comentar sua experiência.

Veja o arquivo [ROADMAP.md](ROADMAP.md) para ter uma ideia de como o projeto deve evoluir.


## 🎫 Licença

Esse projeto é licenciado nos termos da licença open-source [MIT](https://choosealicense.com/licenses/mit) e está disponível de graça.

## Changelog

Veja todas as alterações desse projeto no arquivo [CHANGELOG.md](CHANGELOG.md).

## Projetos semelhantes

Abaixo está uma lista de links interessantes e projetos similares:

- [Gravatar](https://gravatar.com)