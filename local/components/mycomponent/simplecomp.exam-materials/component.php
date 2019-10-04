<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;
	print_r($arParams);
	if($arParams["NEWS"]!=""&& $arParams["KATALOG"]!="")
			{
		if ($this->StartResultCache())
				{
				if(!Loader::includeModule("iblock"))
				{
					ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
					return;
				}
				$temporary=array();
				$arResult=array();
				$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
				$arFilter = Array("IBLOCK_ID"=>$arParams["NEWS"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
				while($ob = $res->GetNext())
				{
				 $arResult[$ob["ID"]]["NAME"]=$ob["NAME"];
				 $arResult[$ob["ID"]]["ID"]=$ob["ID"];
				 $arResult[$ob["ID"]]["DATE_ACTIVE_FROM"]=$ob["DATE_ACTIVE_FROM"];
				 $temporary[]=$ob["ID"];
				}
				//
				$arFilter = array('IBLOCK_ID' => $arParams["KATALOG"], "UF_NEWS_LINK"=>$temporary);
				$rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter,false, array("NAME","ID", "UF_NEWS_LINK"));
				$temporary=array();
				while ($arSection = $rsSections->Fetch())
				{
					foreach ($arSection["UF_NEWS_LINK"] as $key => $value) {

					 $arResult[$value]["KATALOG"][$arSection["ID"]]["NAME"]=$arSection["NAME"];
					}
					 $temporary[]=$arSection["ID"];
				}
				//print_r($arResult);
				foreach ($temporary as $key1 => $value) {

						$arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER");
						$arFilter = Array("IBLOCK_ID"=>$arParams["KATALOG"],"IBLOCK_SECTION_ID"=>$value, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
						$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
						while($ob = $res->GetNext())
						{
							foreach ($arResult as $key2 => $katalog)
							{
								if(isset($arResult[$key2]["KATALOG"][$value]))
								{
									$arResult[$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["NAME"]=$ob["NAME"];
									$arResult[$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["PRICE"]=$ob["PROPERTY_PRICE_VALUE"];
									$arResult[$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["MATERIAL"]=$ob["PROPERTY_MATERIAL_VALUE"];
									$arResult[$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["ARTNUMBER"]=$ob["PROPERTY_ARTNUMBER_VALUE"];
								}
						}
						}
				}
				$this->includeComponentTemplate();
		}
	}
?>
