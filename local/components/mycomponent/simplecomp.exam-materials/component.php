<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

	$this->AddIncludeAreaIcon(
	    array(

	        'URL'   => '/bitrix/admin/iblock_element_admin.php?IBLOCK_ID=1&type=news&lang=ru&apply_filter=Y&back_url_pub=%2F',
	        'TITLE' => "ИБ в админке",
					"IN_PARAMS_MENU" => true, //показать в контекстном меню
	    )
	);

 echo "<a href='/ex2/simplecomp1.php/?F=Y'>/ex2/simplecomp1.php/?F=Y</a>";
 $f=$APPLICATION->GetCurPageParam();
 global $CACHE_MANAGER;

	if($arParams["NEWS"]!=""&& $arParams["KATALOG"]!="")
		{
				$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["KATALOG"]);
				$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["NEWS"]);
		if ($this->StartResultCache())
				{
					echo(time());
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

				foreach ($temporary as $key1 => $value) {

						$arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER");
						if(!strstr($f, 'F=Y'))
						{
								$arFilter = Array("IBLOCK_ID"=>$arParams["KATALOG"],"IBLOCK_SECTION_ID"=>$value, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
						}
						else
						{
								$this->AbortResultCache();
								$arFilter = Array("IBLOCK_ID"=>$arParams["KATALOG"],"IBLOCK_SECTION_ID"=>$value, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","INCLUDE_SUBSECTIONS" => "Y",
								array(
						        "LOGIC" => "OR",
						        array("<=PROPERTY_PRICE" => 1700, "=PROPERTY_MATERIAL" => "Дерево, ткань"),
						        array("<PROPERTY_PRICE" => 1500, "=PROPERTY_MATERIAL" => "Металл, пластик"),
    								),);
						}
						$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
						while($ob = $res->GetNext())
						{
							foreach ($arResult as $key2 => $katalog)
							{
								if(isset($arResult[$key2]["KATALOG"][$value]))
								{
									$arButtons = CIBlock::GetPanelButtons(
										$arParams["KATALOG"],
										$ob["ID"],
										0,
										array("SECTION_BUTTONS"=>false, "SESSID"=>false)
									);
									$arResult[$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
									$arResult[$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
									$arResult[$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["NAME"]=$ob["NAME"];
									$arResult[$key2]["KATALOG"][$value]["VALUE"][$ob["ID"]]["ID"]=$ob["ID"];
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
