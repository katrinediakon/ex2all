<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 3");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:simplecomp3", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"KATALOG" => "",
		"KLASS" => "",
		"KOD" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"NEWS" => "1",
		"AVTOR" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>