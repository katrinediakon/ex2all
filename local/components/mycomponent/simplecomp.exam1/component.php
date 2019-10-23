<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

$this->AddIncludeAreaIcon(
    array(

        'URL' => '/bitrix/admin/iblock_element_admin.php?IBLOCK_ID=1&type=news&lang=ru&apply_filter=Y&back_url_pub=%2F',
        'TITLE' => "ИБ в админке",
        "IN_PARAMS_MENU" => true, //показать в контекстном меню
    )
);

$arParams["NEWS_COUNT"] = intval($arParams["NEWS_COUNT"]);
if ($arParams["NEWS_COUNT"] <= 0)
    $arParams["NEWS_COUNT"] = 20;
echo "<a href='/ex2/simplecomp/simplecomp1.php?F=Y'>/ex2/simplecomp/simplecomp1.php?F=Y</a> </br>";
$f = $APPLICATION->GetCurPageParam();
$arNavParams = array(
    "nPageSize" => '2',
    "bDescPageNumbering" => 'Описание',
    "bShowAll" => 'Y',
);
$arNavigation = CDBResult::GetNavParams($arNavParams);
global $CACHE_MANAGER;

if ($arParams["NEWS"] != "" && $arParams["KATALOG"] != "") {
    $CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["KATALOG"]);
    $CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["NEWS"]);
    if ($this->StartResultCache(false, array($arNavigation, $_GET["F"]))) {
        echo(time());

        if (!Loader::includeModule("iblock")) {
            ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
            return;
        }
        $temporary = array();
        $arResult = array();
        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
        $arFilter = Array("IBLOCK_ID" => $arParams["NEWS"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, $arNavParams, $arSelect);
        $arResult["NAV_STRING"] = $res->GetPageNavStringEx($navComponentObject, 'Заголовок', '', 'Y');
        while ($ob = $res->GetNext()) {
            $arResult["ITEM"][$ob["ID"]]["NAME"] = $ob["NAME"];
            $arResult["ITEM"][$ob["ID"]]["ID"] = $ob["ID"];
            $arResult["ITEM"][$ob["ID"]]["DATE_ACTIVE_FROM"] = $ob["DATE_ACTIVE_FROM"];
            $arIdCatalog[] = $ob["ID"];
        }
        //
        $arFilter = array('IBLOCK_ID' => $arParams["KATALOG"], "UF_NEWS_LINK" => $arIdCatalog);
        $rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter, false, array("NAME", "ID", "UF_NEWS_LINK"));
        $temporary = array();
        while ($arSection = $rsSections->Fetch()) {
            foreach ($arSection["UF_NEWS_LINK"] as $key => $value) {
                if (in_array($value, $arIdCatalog)) {
                    $arResult["ITEM"][$value]["KATALOG"][$arSection["ID"]]["NAME"] = $arSection["NAME"];
                }
            }
            $temporary[] = $arSection["ID"];
        }

        $arResult["COUNT"] = 0;
        foreach ($temporary as $key1 => $value) {

            $arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER");
            if (!strstr($f, 'F=Y')) {
                $arFilter = Array("IBLOCK_ID" => $arParams["KATALOG"], "IBLOCK_SECTION_ID" => $value, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            } else {
                $this->AbortResultCache();
                $arFilter = Array("IBLOCK_ID" => $arParams["KATALOG"], "IBLOCK_SECTION_ID" => $value, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "Y",
                    array(
                        "LOGIC" => "OR",
                        array("<=PROPERTY_PRICE" => 1700, "=PROPERTY_MATERIAL" => "Дерево, ткань"),
                        array("<PROPERTY_PRICE" => 1500, "=PROPERTY_MATERIAL" => "Металл, пластик"),
                    ),);
            }
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

            while ($ob = $res->GetNext()) {
                foreach ($arResult["ITEM"] as $key2 => $katalog) {
                    if (isset($arResult["ITEM"][$key2]["KATALOG"][$value])) {
                        $arButtons = CIBlock::GetPanelButtons(
                            $arParams["KATALOG"],
                            $ob["ID"],
                            0,
                            array("SECTION_BUTTONS" => false, "SESSID" => false)
                        );
                        $arResult["COUNT"]++;
                        if(!$arResult["MAX"] && !$arResult["MIN"]) {
                            $arResult["MAX"]=$ob["PROPERTY_PRICE_VALUE"];
                            $arResult["MIN"]=$ob["PROPERTY_PRICE_VALUE"];
                        }
                        if ($arResult["MAX"] < $ob["PROPERTY_PRICE_VALUE"])
                            $arResult["MAX"] = $ob["PROPERTY_PRICE_VALUE"];
                        if ($arResult["MIN"] > $ob["PROPERTY_PRICE_VALUE"])
                            $arResult["MIN"] = $ob["PROPERTY_PRICE_VALUE"];


                        $arResult["ITEM"][$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
                        $arResult["ITEM"][$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
                        $arResult["ITEM"][$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["NAME"] = $ob["NAME"];
                        $arResult["ITEM"][$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["ID"] = $ob["ID"];
                        $arResult["ITEM"][$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["PRICE"] = $ob["PROPERTY_PRICE_VALUE"];
                        $arResult["ITEM"][$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["MATERIAL"] = $ob["PROPERTY_MATERIAL_VALUE"];
                        $arResult["ITEM"][$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["ARTNUMBER"] = $ob["PROPERTY_ARTNUMBER_VALUE"];
                    }
                }
            }
        }
        $this->SetResultCacheKeys(array("MAX", "MIN", "COUNT"));

        $this->includeComponentTemplate();
    }
    $APPLICATION->SetTitle("Элементов - " . $arResult["COUNT"]);
}

?>
