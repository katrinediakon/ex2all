<?php
AddEventHandler("main", "OnBeforeEventAdd", array("MyEMail", "OnBeforeEventAddHandler"));
use Bitrix\Main\Mail\Event;

class MyEmail
{
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {

      if($event=="FEEDBACK_FORM")
      {
      global $USER;
      if(($USER->GetID()))
      {
        $arFields["AUTHOR"]=$USER->GetID(). " (".$USER->GetLogin().") ".$USER->GetFullName();
        CEventLog::Add(array(
                 "SEVERITY" => "SECURITY",
                 "AUDIT_TYPE_ID" => "MY_OWN_TYPE",
                 "MODULE_ID" => "main",
                 "DESCRIPTION" => "Замена данных в отсылаемом письме – [AUTHOR]".$arFields["AUTHOR"],
              ));
      }

        Event::send(array(
            "EVENT_NAME" => "FEEDBACK_FORM",
            "LID" => "s1",
            "MESSAGE_ID" => 7,
            "C_FIELDS" => array(
                "NAME" => $arFields["AUTHOR"],
                "EMAIL" => $arFields["AUTHOR_EMAIL"],
                "TEXT" => $arFields["TEXT"]
            ),
        ));
      }


    }
}

 ?>
