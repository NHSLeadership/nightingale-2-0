<?php
/**
* Replace css classes in standard navigation with Nightingale classes
*/


function nightingale_pagination()
{
$pagination = get_the_posts_pagination( array(
  'type'               => 'list',
  'screen_reader_text' => 'Other Posts'
));

    $pagination = str_replace("<nav class=\"navigation pagination\" role=\"navigation\">","<nav 
    class=\"nhsuk-pagination\" role=\"navigation\" aria-label=\"Pagination\">",
        $pagination);

    $pagination = str_replace("<div class=\"nav-links\">","",$pagination);
    $pagination = str_replace("</div>","",$pagination);



$pagination = str_replace("<ul class='page-numbers'>","<ul class=\"nhsuk-list nhsuk-pagination__list\">",$pagination);
$li = '<li>';
//find first li amd change to previous
$pos = strpos($pagination, $li);
    if ($pos !== false) {
        $replace = '<li class="nhsuk-pagination-item--previous">';
        $pagination = substr_replace($pagination, $replace, $pos, strlen($li));
    }
    //find last li and change to next
    $pos = strrpos($pagination, $li);
    if ($pos !== false) {
        $replace = '<li class="nhsuk-pagination-item--next">';
        $pagination = substr_replace($pagination, $replace, $pos, strlen($li));
    }
$pagination = str_replace("<li>","<li class=\"nhsuk-pagination-item\">",$pagination);
$pagination = str_replace("<a class='page-numbers'","<a class='nhsuk-pagination__link nhsuk-pagination__link'",$pagination);
$pagination = str_replace('<a class="prev page-numbers"','<a class="nhsuk-pagination__link nhsuk-pagination__link--prev"',$pagination);
$backarrow = '<span class="nhsuk-pagination__title">Previous</span>
        <span class="nhsuk-u-visually-hidden">:</span>
        <svg class="nhsuk-icon nhsuk-icon__arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M4.1 12.3l2.7 3c.2.2.5.2.7 0 .1-.1.1-.2.1-.3v-2h11c.6 0 1-.4 1-1s-.4-1-1-1h-11V9c0-.2-.1-.4-.3-.5h-.2c-.1 0-.3.1-.4.2l-2.7 3c0 .2 0 .4.1.6z"></path>
        </svg>';
$forwardarrow = '<span class="nhsuk-pagination__title">Next</span>
        <span class="nhsuk-u-visually-hidden">:</span>
        <svg class="nhsuk-icon nhsuk-icon__arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M19.6 11.66l-2.73-3A.51.51 0 0 0 16 9v2H5a1 1 0 0 0 0 2h11v2a.5.5 0 0 0 .32.46.39.39 0 0 0 .18 0 .52.52 0 0 0 .37-.16l2.73-3a.5.5 0 0 0 0-.64z"></path>
        </svg>';
    $pagination = str_replace('Previous',$backarrow,$pagination);
    $pagination = str_replace('Next',$forwardarrow,$pagination);
$pagination = str_replace('<a class="next page-numbers"','<a class="nhsuk-pagination__link nhsuk-pagination__link--next"',$pagination);

echo $pagination;
}
