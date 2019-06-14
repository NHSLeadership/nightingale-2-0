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
$pagination = str_replace("<ul class='page-numbers'>","<ul class='c-pagination'>",$pagination);
$pagination = str_replace("<li>","<li class='c-pagination__item'>",$pagination);
$pagination = str_replace("<a class='page-numbers'","<a class='c-pagination__link'",$pagination);
$pagination = str_replace('<a class="prev page-numbers"','<a class="c-sprite c-sprite--prev-blue"',$pagination);
$pagination = str_replace('<a class="next page-numbers"','<a class="c-sprite c-sprite--next-blue"',$pagination);
echo $pagination;
}