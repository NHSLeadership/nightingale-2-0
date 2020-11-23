jQuery(document).on('click', '.bs-dropdown-link.bb-reply-actions-button', function (e) {
  e.preventDefault();
  jQuery(this).siblings('.bb-reply-actions-dropdown').toggle();
  jQuery(this).toggleClass('active button-close');
  if (jQuery(this).hasClass('active')) {
    jQuery(this).text('Close');
  } else {
    jQuery(this).text('Reply / Manage');
  }
});

jQuery(document).on('click', '.bbp-reply-to-link', function (e) {
  e.preventDefault();
  jQuery('.bb-modal-box').fadeIn(500);
});
