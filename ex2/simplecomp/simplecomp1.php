<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 1");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:simplecomp.exam1",
	".default",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"KATALOG" => "2",
		"KOD" => "UF_NEWS_LINK",
		"NEWS" => "1",
		"NEWS_COUNT" => "2",
		"PRODUCTS_IBLOCK_ID" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>