<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оценка производительности");
?><div>
	 ex2-88<br>
</div>
<div>
 <a href="http://example/bitrix/admin/perfmon_hit_list.php?lang=ru&set_filter=Y&find_script_name=%2Fproducts%2Findex.php">/products/index.php</a> - 46.69% <br>
</div>
<div>
	 Измерить размер кеша при работе компонента «по умолчанию» - simplecomp.exam-materials: <nobr>0.005 с</nobr><nobr>; кеш: 3 КБ</nobr>
</div>
<div>
 <nobr></nobr>
</div>
<div>
	 Измерить размер кеша при помещении в него только данных, необходимых в<br>
	 некешируемой части. - simplecomp.exam-materials: <nobr>0.005 с</nobr><nobr>; кеш: 2 КБ</nobr>
</div>
<div>
 <nobr></nobr>Определить разницу и полученный результат записать на странице /ex2/time_control/ - 1КБ<br>
</div>
<div>
 <br>
</div>
<div>
	 ex2-10<br>
</div>
<div>
 <a href="http://example/bitrix/admin/perfmon_hit_list.php?lang=ru&set_filter=Y&find_script_name=%2Fproducts%2Findex.php">/products/index.php</a> - 43.79% <br>
</div>
<div>
	 catalog - 0.0326 c.<br>
</div>
<div>
 <br>
</div>
<div>
	 ex2-11
</div>
<div>
 <a href="http://example/bitrix/admin/perfmon_hit_list.php?lang=ru&set_filter=Y&find_script_name=%2Fproducts%2Findex.php">/products/index.php</a> - 43.79% <br>
</div>
<div>
	 catalog.section: <nobr>0.0385 с</nobr>; Запросов: 27 <br>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>