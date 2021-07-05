# ConstructPagination
##### php >= 5.3


## Описание
Создание объекта Пагинации `ConstructPagination`
```php
$pagination = new ConstructPagination(array(
    'count' => 269,
    'current_page' => $_GET['page']
));
```
<br>

### Доступные методы
* pg_print() - отображает на экране результат;
* pg_return() - возвращает результат;

<br>

### Свойства объекта `ConstructPagination`

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
* `next_text` - Свойство изменяет текст «Вперед», который отображается с более 5 страниц;
* `classes` - Предназначено для изменения стилей пагинации.
    В данных свойствах указываются только пользовательские классы:
    <br>

    * `linkpage` - Нумерция страниц (1,2,3,4...)
    * `current` - Текущая страница
    * `start` - Текст «В начало»
    * `next` - «Вперед»
 
<br>

## Подключение
Подключите файл `ConstructPagination.php` в ваш проект например в файле `app.php`
```php
include 'src/ConstructPagination.php';
```

### Пример использования
```php
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
    'next_text' => 'Вперед'
  )
)); 
?>

<center style="margin-top:15%;">
  <?php $pagenation->pg_print();?>
</center>
```