<?php 
	return array(
		// 'news/([0-9]+)'=>'news/viev',

		'news/([a-z]+)/([0-9]+)'=>'news/viev/$1/$2'
		// 'news'=>'news/index'         //actionIndex в NewsController
		// 'products'=>'product/list'     //actionList в ProductController
	);
?>