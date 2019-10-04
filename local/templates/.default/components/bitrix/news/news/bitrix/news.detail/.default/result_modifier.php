<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}


$arSelect = Array("NAME", "PROPERTY_NEWS");
$arFilter = Array("IBLOCK_ID"=>$arParams["CANONICAL"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_NEWS"=>$arResult["ID"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNext())
{
  $APPLICATION->SetDirProperty("canonical", $ob["NAME"]);
}




?>
