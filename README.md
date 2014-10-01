A Pagination Class in PHP Version 1
=======================================

This is a example on how to write a simple pagination class in php.

## Code Example

Instantiation of the pagination

$pagination = new Pagination();

Define the pagination properties

$pagination->setCurrentPage(4); //The current page

$pagination->setTotalPages(10); //The total number of pages 

$pagination->setBoundaries(2); //The number of links at the beginning and at the end of the pagination

$pagination->setAround(3); //The number of links before and after the current page

Render the pagination

$pagination->render();

DIRECTORY STRUCTURE
___________________

```
root /
|index.php
|--- lib/
     |--- includes.php
     |--- config.php
     |--- pagination.php
|--- css/
|--- fonts/
|--- js/
|--- img/
```

DEMO
____

A Demo is currently available under the following urls:

<a href="http://demos.franciscobarrento.com/paginationphp">http://demos.franciscobarrento.com/paginationphp</a>

FEEDBACK
________

Please send feedback and opinions to <a href="mailto:me@francisco.barrento.com">me@francisco.barrento.com</a>




