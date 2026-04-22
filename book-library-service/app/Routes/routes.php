<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/books', function (RouteCollectorProxy $group) {
    $group->post('', 'BookController:createBook');
    $group->get('', 'BookController:getBooks');
    $group->get('/{id}', 'BookController:getBook');
    $group->put('/{id}', 'BookController:updateBook');
    $group->delete('/{id}', 'BookController:deleteBook');
});