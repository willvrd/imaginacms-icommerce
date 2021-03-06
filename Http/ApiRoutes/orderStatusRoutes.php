<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/order-statuses'/*,'middleware' => ['auth:api']*/], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.icommerce.order-statuses.create',
    'uses' => 'OrderStatusApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.icommerce.order-statuses.index',
    'uses' => 'OrderStatusApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.icommerce.order-statuses.update',
    'uses' => 'OrderStatusApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.icommerce.order-statuses.delete',
    'uses' => 'OrderStatusApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.icommerce.order-statuses.show',
    'uses' => 'OrderStatusApiController@show',
  ]);
  
});