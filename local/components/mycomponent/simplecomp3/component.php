<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}


$arResult["COUNT"]=0;
if(intval($arParams["NEWS"]) > 0)
{
			if($USER->GetID())
			{
				if ($this->StartResultCache(false,  $USER->GetID()))
				{
						$arResult= array();
						// user
						global $USER;
						$group_user="";
						$filter = Array("ID" => $USER->GetID());
						$rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter, array("SELECT"=>array("UF_NEWS_TYPE")));
						while ($arUser = $rsUsers->GetNext()) {
							if($arUser["UF_NEWS_TYPE"])
							  $group_user=$arUser["UF_NEWS_TYPE"];
						}
						$user= array();
						$filter = Array("UF_NEWS_TYPE" => $group_user);
						$rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
						while ($arUser = $rsUsers->GetNext()) {
							if($arUser["ID"]!=$USER->GetID())
							{
									$arResult["ITEM"][$arUser["ID"]]["ID"]=$arUser["ID"];
								  $arResult["ITEM"][$arUser["ID"]]["NAME"]=$arUser["LOGIN"];
							}
							$user[]=$arUser["ID"];
					}

						$new=array();
						$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_NEWS");
						$arFilter = Array("IBLOCK_ID"=>$arParams["NEWS"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_NEWS"=>$user);
						$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
						while($ob = $res->GetNext())
						{

								$new[$ob["ID"]]["NAME"]=$ob["NAME"];
								$new[$ob["ID"]]["ID"]=$ob["ID"];
								$new[$ob["ID"]]["PROPERTY_NEWS"][]=$ob["PROPERTY_NEWS_VALUE"];

						}

						foreach ($new as $key => $value)
						 {
								if(!in_array($USER->GetID(),$value["PROPERTY_NEWS"]) )
								{
									foreach ($value["PROPERTY_NEWS"] as $key => $news) {
										$arResult["ITEM"][$news]["NEWS"][]=$value["NAME"];
										$arResult["COUNT"]++;
									}
								}
						}
						$this->SetResultCacheKeys("COUNT");
						$APPLICATION->SetTitle("Новостей ".$count);
						$this->includeComponentTemplate();
				}
				$APPLICATION->SetTitle("Новостей ".$arResult["COUNT"]);
		}
}

?>
