<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 2");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:simplecomp2",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DETAIL" => "catalog_exam/#SECTION_ID#/#ELEMENT_CODE#",
		"KATALOG" => "2",
		"KLASS" => "7",
		"KOD" => "FABRICK",
		"SORT_BY1" => "ID",
		"SORT_BY2" => "TIMESTAMP_X",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>