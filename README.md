# ConstructPagination
##### php >= 5.3

<br>

## Установка
```
composer require vudev/pagination
```

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

| Свойство     | Тип     | По умолчанию | Обязательно | Описание |
| ------------ | :----: | :----: | :----: | -------- |
| count        | integer | нет            | Да          | Общее кол-во записей (например в БД) |
| current_page | integer | 1            | Да          | Номер текущей страницы (от 1) |
| page_count   | integer | 25           | нет          | Кол-во выводимых записей на одной странице |
| views_page   | integer | 5            | нет          | Кол-во отображаемых нумераций на странице |
| query_key   | string  | page         | нет          | Кол-во отображаемых нумераций на странице |
| temps   | array  | нет         | нет          | Массив дополнительных свойств (см. ниже) |

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