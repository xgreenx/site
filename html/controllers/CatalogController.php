<?php

/**
 * Контроллер CatalogController
 * Каталог тyров
 */
class CatalogController
{

    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex()
    {
        // Список последних товаров
        $tours = Tour::getLatestTours(10);
        // Подключаем вид
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }
	public function actionCountry($country){
		//Список доступных туров по заданной стране
		$tours = Tour::getToursListByCountry($country);
		//Подключаем вид
		require_once(ROOT.'/views/catalog/country.php');
		return true;
	}
	public function actionSale(){
		//Список доступных туров по скидке
		$tours = Tour::getSaleToursList();
		//Подключаем вид
		require_once(ROOT.'/views/catalog/sale.php');
		return true;
		
	}
	
}