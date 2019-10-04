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
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
				while($ob = $res->GetNext())
				{
						$arResult[$ob["ID"]]["NAME"]=$ob["NAME"];
						$arr[]=$ob["ID"];
				}

				$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_FABRICK", "PROPERTY_PRICE", "PROPERTY_MATERIAL" );
				$arFilter = Array("IBLOCK_ID"=>$arParams["LATALOG"], "PROPERTY_FABRICK"=>$arr, "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
				while($ob = $res->GetNext())
				{
					$arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["NAME"]=$ob["NAME"];
					$arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["PRICE"]=$ob["PROPERTY_PRICE_VALUE"];
					$arResult[$ob["PROPERTY_FABRICK_VALUE"]]["KATALOG"][$ob["ID"]]["MATERIAL"]=$ob["PROPERTY_MATERIAL_VALUE"];
				}
			}
		}
	$this->includeComponentTemplate();
}
?>
