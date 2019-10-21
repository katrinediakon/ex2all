<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?$min=10000;$max=0?>

	<?=$arResult["NAV_STRING"]?><br />

<?foreach ($arResult["ITEM"] as $key => $value):?>
		<p><?=$value["NAME"]?> -
		<?=$value["DATE_ACTIVE_FROM"]?>
		<?if(isset($value["KATALOG"])):?>

			<?$strSection=""?>
			<?foreach ($value["KATALOG"] as $key => $section):?>
				<?$strSection.=$section["NAME"].", "?>
			<?endforeach?>
			(<?=substr($strSection, 0, -2)?>)
		<?endif?>
</p>

	<ul>
		<?foreach ($value["KATALOG"] as $key => $section):?>
			<?foreach ($section["VALUE"] as $key => $katalog):?>

				<?$this->AddEditAction($katalog['ID'], $katalog['EDIT_LINK'], CIBlock::GetArrayByID($arParams["KATALOG"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($katalog['ID'], $katalog['DELETE_LINK'], CIBlock::GetArrayByID($arParams["KATALOG"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div  id="<?=$this->GetEditAreaId($katalog['ID']);?>">

				<li><?=$katalog["NAME"]?> - <?=$katalog["PRICE"]?> - <?=$katalog["MATERIAL"]?> - <?=$katalog["ARTNUMBER"]?></li>
				</div>
			<?endforeach?>

		<?endforeach?>
	</ul>

<?endforeach?>

	<br /><?=$arResult["NAV_STRING"]?>
