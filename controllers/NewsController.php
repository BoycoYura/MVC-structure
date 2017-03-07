<?php  
/**
* 
*/
class NewsController
{
	
	public function actionIndex()
	{
		echo "Список новостей";
		return true;
	}

	public function actionViev($category,$id)
	{
		echo "<br>$category";
		echo "<br>$id";

		return true;
	}
}

?>