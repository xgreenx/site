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
	public function actionCountry($country, $page = 1){
		//Список доступных туров по заданной стране
		$tours = Tour::getToursListByCountry($country, $page);
		// Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Tour::getTotalToursInCountry($country);
		
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Tour::SHOW_BY_DEFAULT, '');
		
		
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