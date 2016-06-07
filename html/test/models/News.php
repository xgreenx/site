<?php

class News{
	
	
	public static function getNewsList (){
		
		$db = DB::getConnection();
		
		$newsList = array();
		
		$result = $db->query ('Select id, title, date, short_content '
				. 'FROM news '
				. 'ORDER BY date DESC '
				. 'LIMIT 10');
				
		$i = 0;
		while ($row = $result->fetch()) {
			$newsList[$i]['id'] = $row ['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$i++;
		}
		return $newsList;
	}
	
	static public function getNewsItemById($id){
		
		$db = DB::getConnection();
		
		$result = $db->query ('Select * '
				. 'FROM news '
				. 'WHERE id='.$id);
				
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		return $result->fetch();
	}
}