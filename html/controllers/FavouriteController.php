<?php

/**
 * Контроллер FavouriteController
 * Корзина
 */
class FavouriteController
{
    /**
     * Action для добавления тура в избранные при помощи асинхронного запроса (ajax)
     * @param integer $id <p>id тyрa</p>
     */
    public function actionAddAjax($id)
    {
        // Добавляем тyр в корзину и печатаем результат: количество тyров в избранном
        echo Favourite::addTour($id);
        return true;
    }
    
    /**
     * Action для удаления тура из корзины синхронным запросом
     * @param integer $id <p>id товара</p>
     */
    public function actionDelete($id)
    {
        // Удаляем заданный товар из избранных
        Favourite::deleteTour($id);

        // Возвращаем пользователя в избранные
        header("Location: /Favourite");
    }

    /**
     * Action для страницы "Избранные"
     */
    public function actionIndex()
    {
        // Получим идентификаторы и количество товаров в корзине
        $ToursInFavourite = Favourite::getFavouriteTours();

        if ($ToursInFavourite) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $ToursIds = array_keys($ToursInFavourite);

            // Получаем массив с полной информацией о необходимых товарах
            $Tours = array();
			$i=0;
			foreach ($ToursIds as $id) {
            	$Tours[$i] = Tour::getToursByIds($id);
				$i++;
			}
        }

        // Подключаем вид
        require_once(ROOT . '/views/Favourite/index.php');
        return true;
    }
   }
