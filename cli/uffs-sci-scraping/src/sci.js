const puppeteer = require('puppeteer');

async function login(browser, config) {
    const page = await browser.newPage();

    page.setDefaultTimeout(0);

    await Promise.all([
        page.goto('https://sci.uffs.edu.br/login.jsf'),
        page.waitForNavigation({ waitUntil: 'networkidle0' }),
    ]);

    await page.type('[type=text][name$=login]', config.auth.user + '');
    await page.type('[type=password][name$=senha]', config.auth.password + '');
    await page.click('[type=submit][name$=botaoEntrar]');

    const [error] = await page.$x("//body[contains(., 'inválidos')]");

    if (error) {
        //throw 'Usuário ou senha de acesso invalidos';
    }

    // Login deu certo.
    await page.waitForSelector('a.ui-icon-home');
}

async function launch(config) {
    const browser = await puppeteer.launch(config);
    try {
        await login(browser, config);
    } catch (error) {
        browser.close();
        throw error;
    }
    return browser;
}

async function newTab() {
    var page = await sci.browser.newPage();
    page.setDefaultTimeout(0);

    return page;
}

async function create(config) {
    sci.browser = await launch(config);
    sci.config = config;

    return sci;
}

async function destroy(config) {
    sci.browser.close();
}

var sci = {
    browser: null,
    config: null,
    newTab: newTab
};

module.exports = {
    create,
    destroy,
}