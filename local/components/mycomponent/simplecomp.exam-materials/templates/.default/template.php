<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>

<?foreach ($arResult as $key => $value):?>
<p><?=$value["NAME"]?> -
<?=$value["DATE_ACTIVE_FROM"]?>(
<?foreach ($value["KATALOG"] as $key => $section):?>
<?=$section["NAME"]?>,
<?endforeach?>
)</p>
<?foreach ($value["KATALOG"] as $key => $section):?>
<?foreach ($section["VALUE"] as $key => $katalog):?>
<p><?=$katalog["NAME"]?> - <?=$katalog["PRICE"]?> - <?=$katalog["MATERIAL"]?> - <?=$katalog["ARTNUMBER"]?></p>
<?endforeach?>
<?endforeach?>

<?endforeach?>
