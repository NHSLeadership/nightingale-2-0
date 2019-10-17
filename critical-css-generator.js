const penthouse = require('penthouse')
const fs = require('fs')
// force the critical css to include all variations of the header, as well as hero
// and breadcrumb (if one exists the other wont, we need both in the critical file)
// Also force inclusion of full width layout as well as two columns - a page may
// have one but never both
penthouse({
    url: 'http://localhost/index.php',
    css: 'style.min.css',
    forceInclude: [
        '.nhsuk-header__inverted',
        '.nhsuk-header',
        '.nhsuk-header__transactional-service-name',
        '.nhsuk-header__transactional-service-name--link',
        '.nhsuk-logo',
        '.nhsuk-header__transactional-service-name',
        '.nhsuk-header__organisational-service-name',
        '.nhsuk-header__organisational-qualifier',
        '.nhsuk-hero nhsuk-hero--image',
        '.nhsuk-hero--image-description',
        '.nhsuk-hero__overlay',
        '.nhsuk-hero-content',
        '.nhsuk-hero__arrow',
        '.nhsuk-breadcrumb',
        '.nhsuk-breadcrumb__list',
        '.nhsuk-breadcrumb__item',
        '.nhsuk-grid-column-one-third',
        '.nhsuk-grid-column-two-thirds',
        '.nhsuk-grid-column-full',
        '#secondary',
        '#secondary section',
        '.nhsuk-panel-with-label',
        '.widget-title',
        '.nhsuk-panel-with-label__label',
        '.nhsuk-header__navigation',
        '.nhsuk-header__navigation-title',
        '.nhsuk-header__navigation-list',
        '.nhsuk-header__navigation-item',
        '.nhsuk-header__navigation-link'

    ]
})
    .then(criticalCss => {
        // use the critical css
        fs.writeFileSync('partials/criticalcss.php', criticalCss)
    })
