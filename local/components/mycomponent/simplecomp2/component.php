<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;
if ($this->StartResultCache())
		{
		if(!Loader::includeModule("iblock"))
		{
			ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
			return;
		}
		if($arParams["KATALOG"]!=""&&$arParams["KLASS"]!="")
		{
			if ($this->StartResultCache())
			{
				$arResult= array();
				$arr=array();
				$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
				$arFilter = Array("IBLOCK_ID"=>$arParams["KLASS"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array($arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"], $arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"]), $arFilter, false, Array("nPageSize"=>50), $arSelect);
				while($ob = $res->GetNext())
				{
						$arResult[$ob["ID"]]["NAME"]=$ob["NAME"];
						$arr[]=$ob["ID"];
				}

				$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_".$arParams['KOD'], "PROPERTY_PRICE", "PROPERTY_MATERIAL", "IBLOCK_SECTION_ID" );
				$arFilter = Array("IBLOCK_ID"=>$arParams["KATALOG"], "PROPERTY_".$arParams['KOD']=>$arr, "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array($arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"], $arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"]), $arFilter, false, Array("nPageSize"=>50), $arSelect);
				while($ob = $res->GetNext())
				{

				 	$arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["DETAIL"]=str_replace("#SECTION_ID#", $ob["IBLOCK_SECTION_ID"], $arParams["DETAIL"]);
					$arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["DETAIL"]=str_replace("#ELEMENT_CODE#", $ob["ID"], $arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["DETAIL"]);
					$arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["NAME"]=$ob["NAME"];
					$arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["PRICE"]=$ob["PROPERTY_PRICE_VALUE"];
					$arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["MATERIAL"]=$ob["PROPERTY_MATERIAL_VALUE"];
				}
			}
		}
	$this->includeComponentTemplate();
}
?>
