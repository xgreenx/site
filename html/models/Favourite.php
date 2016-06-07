<?php

/**
 * Класс Favourite - модель для работы с избранными
 */
class Favourite
{

    /**
     * Сохранение избранного
     * @param integer $tour_id<p>id тура</p>
     */
    public static function add($id_tour)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'UPDATE users SET favourite_tours = CONCAT(favourite_tours, :id_tour;)
				 where id_user='.$_SESSION['user'];
        $result = $db->prepare($sql);
        $result->bindParam(':id_tour', $id_tour, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает список избранных туров
     * @return array <p>Список избранных туров</p>
     */
    public static function getFavouriteList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT favourite_tours FROM users WHERE id_user='.$_SESSION['user']);
        $favouritesList = array();
		$favourite_toures = explode(';',$result->fetch()['favourite_toures']);
        $i = 0;
      	foreach($favourite_toures as $favourites){
        	$FavouritesList[$i] = ( int ) $favourites;
			$i++;
			}
        return $FavouritesList;
    }
    /**
     * Удаляет тур с заданным id из избранных
     * @param integer $id <p>id тура</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteFavouriteById($id_tour)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $result = $db->query('SELECT favourite_tours FROM users WHERE id_user='.$_SESSION['user']);
		//замена данного id  тура пустой строкой
		$favourite_tours=str_replace($id.';',"",$result->fetch()['favourite_toures']);
		//Вставляем сторку, с удаленным туром обратно в базу
		$sql='INSERT INTO users (favourite_toures) VALUES (:favourite_tours)';
		$result = $db->prepare($sql);
        $result->bindParam(':favourite_tours', $favourite_toures, PDO::PARAM_STR);
		//возращаем результат выполнения метода
		return $result->execute();
    }
}
