# ConstructPagination
##### php >= 5.3

<br>

## Описание
### Создание объекта
```php
$pagination = new Pagination(array(
    'count' => 269,
    'current_page' => $_GET['page']
));
```
<br>

### Доступные методы
* pg_print() - отображает на экране результат;
* pg_return() - возвращает результат;

<br>

### Свойства объекта `Pagination`

<br>

Основные свойства объекта: <br>

* `count` - Общее кол-во записей (например в БД)
* `current_page` - Номер текущей страницы (от 1):<br>
По умолчанию: 1 
* `page_count` - Кол-во выводимых записей на одной странице:<br>
По умолчанию: 25
* `views_page` - Кол-во отображаемых нумераций на странице<br>
По умолчанию: 5
* `query_key` - Алиас номера страницы передаваемый в GET запросе:<br>
По умолчанию: page
* `temps` - Массив дополнительных свойств

<br>

Дополнительные свойства `temps`: <br>

* `start_text` - Свойство изменяет текст «В начало», который отображается с более 5 страниц;
* `next_text` - Свойство изменяет текст «дальше», который отображается с более 5 страниц;
* `classes` - Предназначено для изменения стилей пагинации.
    В данных свойствах указываются только пользовательские классы:
    <br>

    * `linkpage` - Нумерция страниц (1,2,3,4...)
    * `current` - Текущая страница
    * `start` - Текст «В начало»
    * `next` - Текст «дальше»
 
<br>



### Пример использования
```php
<?php
use Vudev\Page\Pagination;

include __DIR__.'/vendor/autoload.php';

$pagination = new Pagination(array(
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
  <?php $pagination->pg_print();?>
</center>
```