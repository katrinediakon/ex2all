<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?$min=10000;$max=0?>

	<?=$arResult["NAV_STRING"]?><br />

<?foreach ($arResult as $key => $value):?>
<p><?=$value["NAME"]?> -
<?=$value["DATE_ACTIVE_FROM"]?>(
<?foreach ($value["KATALOG"] as $key => $section):?>
<?=$section["NAME"]?>,
<?endforeach?>
)</p>
<?foreach ($value["KATALOG"] as $key => $section):?>
<?foreach ($section["VALUE"] as $key => $katalog):?>

<?$this->AddEditAction($katalog['ID'], $katalog['EDIT_LINK'], CIBlock::GetArrayByID($arParams["KATALOG"], "ELEMENT_EDIT"));
$this->AddDeleteAction($katalog['ID'], $katalog['DELETE_LINK'], CIBlock::GetArrayByID($arParams["KATALOG"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div  id="<?=$this->GetEditAreaId($katalog['ID']);?>">

<p><?=$katalog["NAME"]?> - <?=$katalog["PRICE"]?> - <?=$katalog["MATERIAL"]?> - <?=$katalog["ARTNUMBER"]?></p>
</div>
<?endforeach?>

<?endforeach?>

<?endforeach?>

	<br /><?=$arResult["NAV_STRING"]?>
