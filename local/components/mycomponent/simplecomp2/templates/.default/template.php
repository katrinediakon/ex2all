<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<ul>


<?foreach ($arResult as $key => $value):?>
<li><?=$value["NAME"]?></li>
<ul>
<?foreach ($value["KATALOG"] as $key => $katalog):?>
<li> <?=$katalog["NAME"]?> - <?=$katalog["PRICE"]?> - <?=$katalog["MATERIAL"]?> </li>
<?endforeach?>

</ul>

<?endforeach?>
</ul>
