<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

echo $APPLICATION->SetPAgeProperty("PRICE",'<div style="color:red; margin: 34px 15px 35px 15px">Максимум:'.$arResult["MAX"].'
                                                          Минимум:'.$arResult["MIN"].'
                                                                            </div>');
 ?>
