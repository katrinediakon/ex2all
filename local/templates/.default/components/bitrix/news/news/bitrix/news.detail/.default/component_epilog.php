<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arParams["COMPLAINT"] == "Y" || $_GET["COMPLAINT"] == "Y") {
    $el = new CIBlockElement;
    //return json_encode($templateData["id"]);

    if (!$USER->GetLogin())
        $login = "Не авторизован";
    else {
        $login = $USER->GetLogin();
    }

    $PROP = array();
    $PROP[16] = date("d.m.Y");  // свойству с кодом 12 присваиваем значение "Белый"
    $PROP[17] = $USER->GetID();
    $PROP[18] = $login;
    $PROP[19] = $USER->GetFullName();
    $PROP[20] = $templateData["id"];
    $arLoadProductArray = Array(
        "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID" => 8,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => "Жалоба от " . $USER->GetFullName(),
        "ACTIVE" => "Y",            // активен
    );
    $PRODUCT_ID = $el->Add($arLoadProductArray);
    if ($_POST["complaint"] == "Y") {
        $APPLICATION->RestartBuffer();
        echo $PRODUCT_ID;
        die();
    }
    echo "<script>  document.getElementById('complaint').firstChild.data = 'Ваше мнение учтено, '+" . $PRODUCT_ID . "; </script>";
}

?>
