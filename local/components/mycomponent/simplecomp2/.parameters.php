<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"KATALOG" => array(
			"NAME" => "ID инфоблока с каталогом товаров",
			"TYPE" => "STRING",
		),
			"KLASS" => array(
				"NAME" => "ID инфоблока с классификатором",
				"TYPE" => "STRING",
			),
				"KOD" => array(
					"NAME" => "Код пользовательского свойства разделов каталога",
					"TYPE" => "STRING",
				),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),

	),

);
