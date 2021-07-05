const fs = require('fs');
const os = require('os');
const path = require('path');
const sci = require('./src/sci');
const findAvatar = require('./src/findAvatar');
const { exit } = require('process');

function help() {
    console.log('UFFS SCI Scraper - v1.0.0');
    console.log('Cli para leitura de dados do sistema SCI da UFFS.');
    console.log('');
    console.log('Uso:');
    console.log('  scis [options]');
    console.log('  node main.js [options]');
    console.log('  npm run -- [options]');
    console.log('');
    console.log('Options:');
    console.log('  --config=<str>          Caminho para arquivo config.json (default ./config.json).');
    console.log('  --usuario=<str>         idUFFS do usuário que fará o acesso aos dado no SGA.');
    console.log('                          Por default esse valor é obtido do arquivo de config.');
    console.log('  --senha=<str>           Senha do usuário que fará o acesso aos dado no SGA.');
    console.log('                          Por default esse valor é obtido do arquivo de config.');
    console.log('  --debug, -d             Roda em modo visual, sem ser headless (ignora config).');
    console.log('  --help, -h              Mostra essa ajuda.');
}

function output(result, argv) {
    const text = JSON.stringify(result);
    console.log(text);
}

async function run(argv) {
    if(argv.h || argv.help) {
        return help();
    }

    var configPath = argv.config ? argv.config : path.resolve(path.dirname(require.main.filename), 'config.json.example');

    if(!fs.existsSync(configPath)) {
        throw 'Erro ao carregar config: ' + configPath;
    }

    var configContent = fs.readFileSync(configPath);
    var config = JSON.parse(configContent);

    if(argv.d || argv.debug) config.headless = false;

    if(!argv.usuario) {
        throw 'Nenhum usuário informado via --usuario.';
    }

    if(!argv.senha) {
        throw 'Nenhuma senha informada via --senha.';
    }

    config.auth = {
        user: argv.usuario,
        password: argv.senha
    }

    const instance = await sci.create(config);
    const avatar = await findAvatar.run(instance);
    
    output(avatar, argv);
    
    sci.destroy();
}

var argv = require('minimist')(process.argv.slice(2));

process.on('unhandledRejection', (reason, p) => {
    console.log(reason);
    exit(99);
});

try {
    run(argv);
    return 0;

} catch(error) {
    console.log(error);
    exit(9);
}
