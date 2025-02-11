<?php  

$xmlData = file_get_contents("php://input");





$xml = simplexml_load_string($xmlString);

echo '<pre>';
print_r($xml);
echo '</pre>';
?>
