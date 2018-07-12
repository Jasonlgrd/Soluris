<?php

$connexion = mysqli_connect("jasonlagcp1.mysql.db","jasonlagcp1","Jason17240","	jasonlagcp1");
//mysql_set_charset($connexion,"SET NAMES utf8");
$result = mysqli_query($connexion,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$result = mysqli_query($connexion,"SELECT * FROM Soluris");

$data = array();

while ($row = mysqli_fetch_row($result)) 
{
	$data[] = $row;
}
echo json_encode($data);

?>