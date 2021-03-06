<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/manufacturers'/*,'middleware' => ['auth:api']*/], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();

  $router->post('/', [
    'as' => $locale . 'api.icommerce.manufacturers.create',
    'uses' => 'ManufacturerApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.icommerce.manufacturers.index',
    'uses' => 'ManufacturerApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.icommerce.manufacturers.update',
    'uses' => 'ManufacturerApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.icommerce.manufacturers.delete',
    'uses' => 'ManufacturerApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.icommerce.manufacturers.show',
    'uses' => 'ManufacturerApiController@show',
  ]);

});
