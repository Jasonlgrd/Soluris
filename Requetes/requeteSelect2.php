<?php

$donne=$_GET['niv1'];
//$donne="LOG";

$connexion = mysqli_connect("localhost","root","root","soluris");
$result = mysqli_query($connexion,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$result = mysqli_query($connexion,"SELECT DISTINCT `Type de problème` FROM Soluris WHERE `Type de problème` LIKE '$donne%'");

$data = array();

$cpt=0;
while ($row = $result->fetch_row())
{
	$cpt=$cpt+1;
	//echo $cpt;
	$position_premier_antislash=strpos($row[0],"\\")+1;

	$position_deuxieme_antislash=strpos($row[0],"\\",$position_premier_antislash);
	//echo "position du second flash ".$position_deuxieme_antislash."<br>";

	if ($position_deuxieme_antislash==NULL) {
		$chaine = substr($row[0], $position_premier_antislash);
	} else {
		$a = substr($row[0], 0,$position_premier_antislash);
		$c = strlen($a);
		//echo "taille debut de la chaine ".$c."<br>";
		$b = substr($row[0], $position_deuxieme_antislash);
		$d = strlen($b);
		//echo "taille de la fin de la chaine ".$d."<br>";

		$calcul_dif=$d+$c;
		//echo "calcul de la différence d et c ".$calcul_dif."<br>";


		$taille_de_la_chaine=strlen($row[0]);
		//echo "taile de la chaine entière ".$taille_de_la_chaine."<br>";

		$calcul_dif_ter=strlen($row[0])-$calcul_dif;

		//echo "calcul de la dirréence fini ".$calcul_dif_ter."<br>";



		$chaine = substr($row[0], $position_premier_antislash,$calcul_dif_ter);
	}

	

	//echo $chaine."<br>"."<br>";

	//$data[] = $chaine;

	if (!empty($chaine)) {
		if (in_array($chaine, $data)) {
		# code...
		} else {
			$data[] = $chaine;
		}
	}
}

echo json_encode($data);

?>