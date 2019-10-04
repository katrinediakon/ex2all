<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"NEWS" => array(
			"NAME" => "ID информационного блока с новостями",
			"TYPE" => "STRING",
		),
			"AVTOR" => array(
				"NAME" => "Код свойства информационного блока",
				"TYPE" => "STRING",
			),
				"KOD" => array(
					"NAME" => "Код пользовательского свойства пользователей",
					"TYPE" => "STRING",
				),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),

	),

);
