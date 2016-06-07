<?php

/**
 * Контроллер AdminTourController
 * Управление тyрами в админпанели
 */
class AdminTourController extends AdminBase
{

    /**
     * Action для страницы "Управление турами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список товаров
        $ToursList = Tour::getToursList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_tour/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить тур"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['country'] = $_POST['country'];
            $options['value'] = $_POST['value'];
            $options['content'] = $_POST['content'];
            $options['short_content'] = $_POST['short_content'];
            $options['isnew'] = $_POST['isnew'];
            $options['issale'] = $_POST['issale'];
            $options['images_array'] = $_POST['images_array'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name']) || 
                !isset($options['country']) || empty($options['country']) ||
			    !isset($options['value']) || empty($options['value']) ||
				!isset($options['content']) || empty($options['content'])) {
					$errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                //Проверим заполнено ли краткое описание
                	if(!isset($options['short_content']) || empty($options['short_content'])){
						//обрежем текст на определенное кол-во символов
						$options['short_content']=substr($options['content'],0,200);
						//убедимся, что не заканчивается на разделители
						$options['short_content']=rtrim($options['content'],"!,.-") ;
						//Напоследок находим последний пробел, устраняем его и ставим троеточие
						$options['short_content']=substr($options['short_content'], 0, strrpos($options['short_content'], ' '));
					} 
                	
                // Добавляем новый товар
                $id = Tour::createTour($options);
                // Если запись добавлена
                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/product");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать тур"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();
        // Получаем данные о конкретном заказе
        $tour = Tour::getTourById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
			$options['name'] = $_POST['name'];
            $options['country'] = $_POST['country'];
            $options['value'] = $_POST['value'];
            $options['content'] = $_POST['content'];
            $options['short_content'] = $_POST['short_content'];
            $options['isnew'] = $_POST['isnew'];
            $options['issale'] = $_POST['issale'];
            $options['images_array'] = $_POST['images_array'];

            // Сохраняем изменения
            Tour::updateTourById($id, $options);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/tour");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_tour/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить тyр"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            Tour::deleteTourById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/tour");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_tour/delete.php');
        return true;
    }

}
