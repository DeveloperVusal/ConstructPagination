<?php
header('Content-Type: text/html; charset=utf-8');

include 'src/ConstructPagination.php';

$pagenation = new ConstructPagination(array(
  'count' => 600,
  'current_page' => $_GET['page_n'],
  'page_count' => 25,
  'views_page' => 5,
  'query_key' => 'page_n',
  
  'temps' => array(
    'start_text' => 'На старт',
    'next_text' => 'вперед',
    'classes' => array(
      'linkpage' => 'pagination_linkpage',
      'current' => 'pagination_linkpage_current',
      'start' => 'pagination_start',
      'next' => 'pagination_next'
    ),
  )
)); 
?>

<center style="margin-top:15%;">
  <?php $pagenation->pg_print();?>
</center>