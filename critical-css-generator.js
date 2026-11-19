const penthouse = require('penthouse')
const fs = require('fs')
// force the critical css to include all variations of the header, as well as hero
// and breadcrumb (if one exists the other wont, we need both in the critical file)
// Also force inclusion of full width layout as well as two columns - a page may
// have one but never both
penthouse({
    url: 'https://demo.local/index.php',
    css: 'style.min.css',
    timeout: 70000,
    puppeteer: {
    getBrowser: () =>
      require('puppeteer').launch({
        args: ['--no-sandbox', '--disable-setuid-sandbox']
      })
    },
    forceInclude: [
        //'.nhsuk-header__inverted',
        '.nhsuk-header',
        '.nhsuk-header--organisation',
        '.nhsuk-header--white',
        '.nhsuk-header__container',
        '.nhsuk-header__service',
        '.nhsuk-header__service-logo',
        '.nhsuk-header__service-name',
        '.nhsuk-header__logo',
        '.nhsuk-header__organisation-logo',
        '.nhsuk-header__organisation-name',
        '.nhsuk-header__organisation-name-split',
        '.nhsuk-header__organisation-name-descriptor',
        '.nhsuk-header--white .nhsuk-header__service-logo',
        '.nhsuk-header--white .nhsuk-header__service-name[href]',
        '.nhsuk-header__search',
        '.nhsuk-header__search-form',
        '.nhsuk-header__search-form .nhsuk-form-group',
        '.nhsuk-header__search-form .nhsuk-input-wrapper',
        '.nhsuk-header__search-form .nhsuk-input',
        '.nhsuk-header__search .nhsuk-icon--search',
        '.nhsuk-header__navigation',
        '.nhsuk-header__navigation-container',
        '.nhsuk-header__navigation-list',
        '.nhsuk-frontend-supported .nhsuk-header__navigation-list',
        '.nhsuk-header__navigation-item',
        '.nhsuk-header__navigation-link',
        '.nhsuk-header__menu',
        '.nhsuk-header__menu-toggle',
        '.nhsuk-skip-link',
        '.nhsuk-icon',
        '.nhsuk-input-wrapper',
        '.nhsuk-button--icon',
        '.nhsuk-button--small',
        '.nhsuk-breadcrumb',
        '.nhsuk-breadcrumb__list',
        '.nhsuk-breadcrumb__list-item',
        '.nhsuk-breadcrumb__link',
        '.nhsuk-back-link',
        '.nhsuk-hero nhsuk-hero--image',
        '.nhsuk-hero--image-description',
        '.nhsuk-hero__overlay',
        '.nhsuk-hero-content',
        '.nhsuk-hero__content',
        '.nhsuk-hero__arrow',
        '.nhsuk-grid-column-one-third',
        '.nhsuk-grid-column-two-thirds',
        '.nhsuk-grid-column-full',
        '.nhsuk-grid-row',
        '.nhsuk-grid-row:after',
        '#secondary',
        '#secondary section',
        '.nightingale-latest-news',
        '.nhsuk-panel-group',
        '.nhsuk-panel-with-label',
        '.nhsuk-panel',
        '.widget-title',
        '.nhsuk-panel-with-label__label',
        '*, :after, :before',
        '.nhsuk-action-link',
        '.nhsuk-icon--arrow-right-circle',
        '.nhsuk-action-link__text',
        '.nhsuk-main-wrapper',
        '.nhsuk-width-container',
        '.screen-reader-text',
        '.nhsuk-u-visually-hidden',
        '.nhsuk-footer',
        '.nhsuk-footer__meta',
        '.nhsuk-footer__list',
        '.nhsuk-footer__list-item',
        '.nhsuk-footer__list-item-link',
        'article, aside, footer, header, nav, section',
        '#cookie-notice',
        '#primary.clear',
        '.nhsuk-global-alert'
    ]
})
    .then(criticalCss => {
        // use the critical css
        fs.writeFileSync('partials/criticalcss.php', criticalCss)
    })
