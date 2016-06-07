<?php

/**
 * Контроллер TourController
 * Тyр
 */
class TourController
{

    /**
     * Action для страницы просмотра тyра
     * @param integer $productId <p>id тyра</p>
     */
    public function actionView($tourId)
    {
        // Получаем инфомрацию о тyре
        $tour = Tour::getTourById($tourId);

        // Подключаем вид
        require_once(ROOT . '/views/tour/view.php');
        return true;
    }
	
	public function actionAjaxValue($country){
		
		$value = Tour::getValueOfTours($country);
		
        require_once(ROOT . '/views/site/ajaxView.php');
        return true;
	}

}
