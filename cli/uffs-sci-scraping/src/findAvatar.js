const path = require('path');

async function acessaPagina(sga) {
    const page = await sga.newTab();
    
    await Promise.all([
        page.goto('https://sci.uffs.edu.br/restrito/solicitacao/solicitacao.jsf'),
        page.waitForNavigation({ waitUntil: 'networkidle0' }),
    ]);    

    await page.waitForSelector('a.ui-icon-home');

    return page;
}

async function coletaAvatarUrl(page) {
    const url = await page.evaluate(() => {
        var url = '';
        document.querySelectorAll('img#foto').forEach(function(el) {
            url = el.currentSrc;
        });
        return url;
    });
    return url;
}

async function run(sci) {
    const page = await acessaPagina(sci);
    const avatarUrl = await coletaAvatarUrl(page);

    return {
        avatarUrl: avatarUrl
    };
}

module.exports = {
    run
}