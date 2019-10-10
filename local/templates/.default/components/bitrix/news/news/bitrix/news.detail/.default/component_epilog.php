<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arParams["COMPLAINT"]=="Y" || $_GET["COMPLAINT"]=="Y")
{
    $el = new CIBlockElement;
    //return json_encode($templateData["id"]);

    if(!$USER->GetLogin())
    $login="Не авторизован";
    else {
      $login=$USER->GetLogin();
    }

    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
      "IBLOCK_ID"      => 8,
      "PROPERTY_ID"=> $USER->GetID(),
      "PROPERTY_DATE"=> date(d.m.Y),
      "PROPERTY_LOGIN"=> $login,
      "PROPERTY_FIO"=> $USER->GetFullName(),
      "PROPERTY_NEWS_ID"=> $templateData["id"],
      "NAME"           => "Жалоба от ".$USER->GetFullName(),
      "ACTIVE"         => "Y",            // активен
      );
      $PRODUCT_ID = $el->Add($arLoadProductArray);
      if($_POST["complaint"]=="Y")
      {

          $APPLICATION->RestartBuffer();
          echo $PRODUCT_ID;
          die();
      }
  echo "<script>  document.getElementById('complaint').firstChild.data = 'Ваше мнение учтено, '+".$PRODUCT_ID."; </script>";
}

 ?>
