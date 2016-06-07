<?php
return array(

	'news/([a-z]+)/([0-9]+)\b' => 'news/view/$1/$2',
	'news\b' => 'news/index',
	"product/([a-z]+)" => "product/list/$1",
	"product" => "product/list",
);
