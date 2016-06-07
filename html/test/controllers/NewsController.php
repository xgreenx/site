<?php
class NewsController {
	
	public function actionIndex()
	{
		$newsList = array();
		$newsList = News::getNewsList(); 
		
		include(ROOT.'/view/news/index.php');
		
		return true;
	}
	
	public function actionView($category, $id)
	{
		if($id){
			$newItem = News::getNewsItemById($id);
			
			include(ROOT.'/view/news/indexView.php');
		}
		return true;
	}
}