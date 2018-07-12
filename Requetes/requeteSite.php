<?php

$donne=$_GET['debut'];
$donne=str_replace("\\", "\\\\\\\\", $donne);
//$donne="LOG";

$connexion = mysqli_connect("jasonlagcp1.mysql.db","jasonlagcp1","Jason17240","	jasonlagcp1");
$result = mysqli_query($connexion,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$result = mysqli_query($connexion,"SELECT DISTINCT `Site` FROM Soluris WHERE `Site` LIKE '$donne%'");

$data = array();

while ($row = $result->fetch_row())
{

	//$position_antislash=strpos($row[0],"\\")+1;
	//$chaine = substr($row[0], $position_antislash);

	$data[]=$row[0];
}

echo json_encode($data);

?>