<?php

return array(
    // Товар:
    'tour/([0-9]+)' => 'tour/view/$1', // actionView в TourController
    // Каталог:
    'catalog' => 'catalog/index', // actionIndex в CatalogController
    // Категория товаров:
    'country/([A-Z]+)/([0-9]+)' => 'catalog/country/$1/$2', // actionCountry в CatalogController   
    'country/([A-Z]([a-z]+))' => 'catalog/country/$1', // actionCountry в CatalogController
    'sale'=>'catalog/sale',//actionSale в CatalogController
    // Корзина:
    'favourite/checkout' => 'favourite/checkout', // actionAdd в FavouriteController    
    'favourite/delete/([0-9]+)' => 'favourite/delete/$1', // actionDelete в FavouriteController    
    'favourite/add/([0-9]+)' => 'favourite/add/$1', // actionAdd в FavouriteController    
    'favourite/addAjax/([0-9]+)' => 'favourite/addAjax/$1', // actionAddAjax в FavouriteController
    'favourite' => 'favourite/index', // actionIndex в CartController
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    // Управление турами:    
    'admin/tour/create' => 'adminTour/create',
    'admin/tour/update/([0-9]+)' => 'adminTour/update/$1',
    'admin/tour/delete/([0-9]+)' => 'adminTour/delete/$1',
    'admin/tour' => 'adminTour/index',
    // Админпанель:
    'admin' => 'admin/index',
    // О магазине
    'contacts' => 'site/contact',
    'about' => 'site/about',
    
	'ajaxValue/([A-Z]+)' => 'tour/ajaxValue/$1',
	
    // Главная страница
    'index' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
