<?php

/**
 * Класс Tour - модель для работы с товарами
 */
class Tour
{

    // Количество отображаемых туров по умолчанию
    const SHOW_BY_DEFAULT = 10;

	public static function getValueOfTours($country){
		        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT summ_sign FROM tours WHERE country = "'.$country.'"';
		$result = $db->prepare($sql);
		$result->execute();
		
		$summ = 0.0;
		$count = 0;
		
		while($row = $result->fetch()){
			$summ += $row['summ_sign'];
			++$count;
		}
		
		if($count) $summ /= $count;
		
		return array(
			"summ" => $summ,
			"count" => $count
		);
	}

    /**
     * Возвращает массив последних туров
     * @param type $count [optional] <p>Количество</p>
     * @param type $page [optional] <p>Номер текущей страницы</p>
     * @return array <p>Массив с турами</p>
     */
    public static function getLatestTours($count = self::SHOW_BY_DEFAULT)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT id_tour, name, country, value,short_content, isnew, date FROM tours '
                . 'ORDER BY date DESC '
                . 'LIMIT :count';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение комaнды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $ToursList = array();
        while ($row = $result->fetch()) {
            $ToursList[$i]['id_tour'] = $row['id_tour'];
            $ToursList[$i]['name'] = $row['name'];
			$ToursList[$i]['country'] = $row['country'];
            $ToursList[$i]['value'] = $row['value'];
			$ToursList[$i]['short_content'] = $row['short_content'];
            $ToursList[$i]['isnew'] = $row['isnew'];
			$ToursList[$i]['date']=$row['date'];
            $i++;
        }
        return $ToursList;
    }

    /**
     * Возвращает список туров в указанной стране
     * @param type $country name 
     * @param type $page [optional] <p>Номер страницы</p>
     * @return type <p>Массив с турами</p>
     */
    public static function getToursListByCountry($_country, $page)
    {
        $limit = Tour::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
       	$offset = (int)($page - 1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM tours '
        		. 'WHERE country = :country '
                . ' ORDER BY date Desc LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':country', $_country, PDO::PARAM_STR);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение комaнды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $Tours = array();
        while ($row = $result->fetch()) {
            $Tours[$i]['id_tour'] = $row['id_tour'];
            $Tours[$i]['name'] = $row['name'];
            $Tours[$i]['value'] = $row['value'];
            $Tours[$i]['isnew'] = $row['isnew'];
			$Tours[$i]['country']=$row['country'];
            $i++;
        }
        return $Tours;
    }
	/*
	 * Возвращает список туров со скидкой
     * @param type $country name 
     * @param type $page [optional] <p>Номер страницы</p>
     * @return type <p>Массив с турами</p>
     */
	public static function getSaleToursList()
    {
        //$limit = Tour::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
       // $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM tours '
        		. 'WHERE issale > 0';
                //. 'ORDER BY date Desc LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        //$result->bindParam(':limit', $limit, PDO::PARAM_INT);
        //$result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение комaнды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $Tours = array();
        while ($row = $result->fetch()) {
            $Tours[$i]['id_tour'] = $row['id_tour'];
            $Tours[$i]['name'] = $row['name'];
            $Tours[$i]['value'] = $row['value']*(1-$row['issale']/100);
			$Tours[$i]['country']=$row['country'];
            $i++;
        }
        return $Tours;
    }

    /**
     * Возвращает продукт с указанным id
     * @param integer $id <p>id товара</p>
     * @return array <p>Массив с информацией о товаре</p>
     */
    public static function getTourById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM tours WHERE id_tour = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }

    /**
     * Возвращаем количество туров в указанной стране
     * @param integer $categoryId
     * @return integer
     */
    public static function getTotalToursInCountry($country)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id_tour) AS count FROM tours WHERE country = :country';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':country', $country, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Возвращает список туров с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком туров</p>
     */
    public static function getToursByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM tours WHERE id_tour IN ($idsString)";

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $Tours = array();
        while ($row = $result->fetch()) {
            $Tours[$i]['id_tour'] = $row['id_tour'];
            $Tours[$i]['name'] = $row['name'];
            $Tours[$i]['country'] = $row['country'];
            $Tours[$i]['value'] = $row['value'];
            $i++;
        }
        return $Tours;
    }


    /**
     * Возвращает список туров
     * @return array <p>Массив с товарами</p>
     */
    public static function getToursList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id_tour, name, value, country FROM tours ORDER BY id ASC');
        $ToursList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ToursList[$i]['id_tour'] = $row['id_tour'];
            $ToursList[$i]['name'] = $row['name'];
            $ToursList[$i]['country'] = $row['country'];
            $ToursList[$i]['value'] = $row['value'];
            $i++;
        }
        return $ToursList;
    }

    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteTourById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM tours WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует тур с заданным id
     * @param integer $id <p>id товара</p>
     * @param array $options <p>Массив с информацей о товаре</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateTourById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE tours
            SET 
                name = :name, 
                country = :country, 
                value = :value, 
                summ_sign = :summ_sign, 
                content= :content, 
                short_content=:short_content,
                isnew = :isnew, 
                issale = :issale, 
                images_array = :images_array, 
            WHERE id_tour = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':country', $options['country'], PDO::PARAM_STR);
        $result->bindParam(':value', $options['value'], PDO::PARAM_STR);
        $result->bindParam(':summ_sign', $options['summ_sign'], PDO::PARAM_STR);
        $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $result->bindParam(':isnew', $options['isnew'], PDO::PARAM_INT);
        $result->bindParam(':issale', $options['issale'], PDO::PARAM_INT);
        $result->bindParam(':images_array', $options['images_array'], PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createTour($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO tours '
                . '(name, country, value, summ_sign, content, short_content, isnew, issale, images_array)'
                . 'VALUES '
                . '(:name, :country, :value, :summ_sign, :content,:short_content, :isnew, :issale, :images_array)';

        // Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':country', $options['country'], PDO::PARAM_STR);
        $result->bindParam(':value', $options['value'], PDO::PARAM_STR);
        $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $result->bindParam(':isnew', $options['isnew'], PDO::PARAM_INT);
        $result->bindParam(':issale', $options['issale'], PDO::PARAM_INT);
        $result->bindParam(':images_array', $options['images_array'], PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    /**
     * Возвращает путь к изображениям
     * @param integer $id
     * @return array <p>Пути к изображениям</p>
     */
    public static function getImages($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
		
		// Соединение с БД
        $db = Db::getConnection();

        // Получение результатов
        $sql = ('SELECT images_array, country FROM tours WHERE id_tour=:id');
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		$result->execute();
		
		$row = $result->fetch();
		
        // Путь к папке с товарами
        $path = '/upload/images/Tours/';
		
		//Разбиваем массив с названиями изображений по ';'
		$images_name = explode(";", $row['images_array']);

		$pathToTourImages = array();
        // Путь к изображениям туров
        $i=0;
        foreach($images_name as $name){
        	$pathToTourImages[$i] = $path.$row['country'].'/'.$name.'.jpg';
			if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToTourImages[$i])){
				++$i;
			}
			
		}

        if ($i>0) {
            // Если существует хотя бы 1 изображение
            // Возвращаем путь изображений туров
            return $pathToTourImages;
        }

        // Возвращаем путь изображения-пустышки
        return array($path.$noImage);
    }

}
