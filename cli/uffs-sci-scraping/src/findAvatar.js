const path = require('path');

async function accessPage(sga) {
    const page = await sga.newTab();
    
    await Promise.all([
        page.goto('https://sci.uffs.edu.br/restrito/solicitacao/solicitacao.jsf'),
        page.waitForNavigation({ waitUntil: 'networkidle0' }),
    ]);    

    await page.waitForSelector('a.ui-icon-home');

    return page;
}

async function collectAvatarUrl(page) {
    const url = await page.evaluate(() => {
        return document.querySelector('img#foto').currentSrc;
    });

    return url;
}

async function run(sci) {
    const page = await accessPage(sci);
    const avatarUrl = await collectAvatarUrl(page);
    const cookies = (await page.cookies()).filter(cookie => cookie.name === 'JSESSIONID');

    return {
        avatarUrl: avatarUrl,
        cookie: cookies[0].name + '=' + cookies[0].value,
    };
}

module.exports = {
    run
}