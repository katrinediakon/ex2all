<?
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("MyClass", "OnBeforeIBlockElementDeleteHandler"));

class MyClass
{
    // создаем обработчик события "OnBeforeIBlockElementDelete"
    function OnBeforeIBlockElementDeleteHandler($ID)
    {
      if($arFields['IBLOCK_ID'] == 2){
        $res=  CIBlockElement::GetByID($ID);
            if($ar_res = $res->GetNext())
            {

              if($ar_res['SHOW_COUNTER']>=1)
              {
                             global $APPLICATION;
                             $APPLICATION->throwException("Нельзы удалить. Количество просмотров ". $ar_res['SHOW_COUNTER']);
                             return false;
              
          }
        }
      }
    }
}
?>
