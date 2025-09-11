jQuery(window).on('load', function () {
  // Add data-module attributes to NHS elements
  const nhsClasses = [
    'nhsuk-checkboxes',
    'nhsuk-radios',
    'nhsuk-error-summary',
    'nhsuk-header',
    'nhsuk-skip-link'
  ];

  nhsClasses.forEach(function (cls) {
    jQuery('.' + cls).each(function () {
      if (!jQuery(this).attr('data-module')) {
        jQuery(this).attr('data-module', cls);
      }
    });
  });
});
