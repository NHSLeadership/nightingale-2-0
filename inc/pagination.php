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
$pagination = str_replace("<li>","<li class=\"nhsuk-pagination-item\">",$pagination);
$pagination = str_replace("<a class='page-numbers'","<a class='nhsuk-pagination__link nhsuk-pagination__link'",$pagination);
$pagination = str_replace('<a class="prev page-numbers"','<a class="nhsuk-pagination__link nhsuk-pagination__link--prev"',$pagination);
$pagination = str_replace('<a class="next page-numbers"','<a class="nhsuk-pagination__link nhsuk-pagination__link--next"',$pagination);
echo $pagination;
}
