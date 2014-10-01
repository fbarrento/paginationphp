## Synopsis

A Pagination in PHP.

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



