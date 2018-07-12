<?php

$connexion = mysqli_connect("localhost","root","root","soluris");
$connexion->query("TRUNCATE TABLE Soluris");

$importation=0;

extract(filter_input_array(INPUT_POST));

$fichier=$_FILES["userfile"]["name"];

if($fichier){
	$fp = fopen($_FILES["userfile"]["tmp_name"], "r");

	$extentions_valides = array('csv');
	$extension_upload = strtolower(  substr(  strrchr($fichier, '.')  ,1)  );

	if (in_array($extension_upload,$extentions_valides)){
		$importation=1;
	} else {
		?>
	 		<p>Mauvais format</p>
	 		<p><a href="index.php?action=import">Réessayer</a></p>
	 	<?php
	}

} else {
	?>
	<p>Importation echouée</p>
	<p>Désolé, mais vous n'avez pas spécifié de chemin valide...</p>
	<p><a href="index.php?action=import">Réessayer</a></p>
	<?php
}


if ($importation==1) {
	//Déclaration de la variable "cpt" qui permettra de compter le nombre d'enregistrement réalisé
	$cpt=0;
	?>
	<p>Importation Reussie</p>
	<?php
	while(!feof($fp)){
		$liste = fgetcsv($fp,0,';','"','"');

		$champs1=$liste[0];
		$champs2=$liste[1];
		$champs3=$liste[2];
		$champs4=$liste[3];

		$champs5=$liste[4];

		$champs6=$liste[5];
		$champs7=$liste[6];
		$champs8=$liste[7];
		$champs9=$liste[8];
		$champs10=$liste[9];
		$champs11=$liste[10];
		$champs12=$liste[11];
		$champs13=$liste[12];
		$champs14=$liste[13];
		$champs15=$liste[14];
		$champs16=$liste[15];
		$champs17=$liste[16];
		$champs18=$liste[17];
		$champs19=$liste[18];
		$champs20=$liste[19];
		$champs21=$liste[20];
		$champs22=$liste[21];
		$champs23=$liste[22];
		$champs24=$liste[23];
		$champs25=$liste[24];
		$champs26=$liste[25];

		$champs1=str_replace("'", "''", $champs1);
		$champs2=str_replace("'", "''", $champs2);
		$champs3=str_replace("'", "''", $champs3);
		$champs4=str_replace("'", "''", $champs4);
		$champs5=str_replace("'", "''", $champs5);
		$champs6=str_replace("'", "''", $champs6);
		$champs7=str_replace("'", "''", $champs7);
		$champs8=str_replace("'", "''", $champs8);
		$champs9=str_replace("'", "''", $champs9);
		$champs10=str_replace("'", "''", $champs10);
		$champs11=str_replace("'", "''", $champs11);
		$champs12=str_replace("'", "''", $champs12);
		$champs13=str_replace("'", "''", $champs13);
		$champs14=str_replace("'", "''", $champs14);
		$champs15=str_replace("'", "''", $champs15);
		$champs16=str_replace("'", "''", $champs16);
		$champs17=str_replace("'", "''", $champs17);
		$champs18=str_replace("'", "''", $champs18);
		$champs19=str_replace("'", "''", $champs19);
		$champs20=str_replace("'", "''", $champs20);
		$champs21=str_replace("'", "''", $champs21);
		$champs22=str_replace("'", "''", $champs22);
		$champs23=str_replace("'", "''", $champs23);
		$champs24=str_replace("'", "''", $champs24);
		$champs25=str_replace("'", "''", $champs25);
		$champs26=str_replace("'", "''", $champs26);

		$champs1=str_replace("\\", "\\\\", $champs1);
		$champs2=str_replace("\\", "\\\\", $champs2);
		$champs3=str_replace("\\", "\\\\", $champs3);
		$champs4=str_replace("\\", "\\\\", $champs4);
		$champs5=str_replace("\\", "\\\\", $champs5);
		$champs6=str_replace("\\", "\\\\", $champs6);
		$champs7=str_replace("\\", "\\\\", $champs7);
		$champs8=str_replace("\\", "\\\\", $champs8);
		$champs9=str_replace("\\", "\\\\", $champs9);
		$champs10=str_replace("\\", "\\\\", $champs10);
		$champs11=str_replace("\\", "\\\\", $champs11);
		$champs12=str_replace("\\", "\\\\", $champs12);
		$champs13=str_replace("\\", "\\\\", $champs13);
		$champs14=str_replace("\\", "\\\\", $champs14);
		$champs15=str_replace("\\", "\\\\", $champs15);
		$champs16=str_replace("\\", "\\\\", $champs16);
		$champs17=str_replace("\\", "\\\\", $champs17);
		$champs18=str_replace("\\", "\\\\", $champs18);
		$champs19=str_replace("\\", "\\\\", $champs19);
		$champs20=str_replace("\\", "\\\\", $champs20);
		$champs21=str_replace("\\", "\\\\", $champs21);
		$champs22=str_replace("\\", "\\\\", $champs22);
		$champs23=str_replace("\\", "\\\\", $champs23);
		$champs24=str_replace("\\", "\\\\", $champs24);
		$champs25=str_replace("\\", "\\\\", $champs25);
		$champs26=str_replace("\\", "\\\\", $champs26);

		$cpt++;
		//echo $cpt;
		$db = mysqli_connect("localhost","root","root","soluris");
		if ($cpt>5) {

			//CONVERSTION EN DATE
			$tab = explode( ' ', $champs5 );
			if (!empty($tab)) {
				list( $jour, $mois, $annee ) = explode( '/', $tab[0] );
			}
			$champs5 = $annee .'-'. $mois .'-'. $jour;
			//--------------------------------------------------------

			$sql = ("INSERT INTO Soluris VALUES('$champs1','$champs2','$champs3','$champs4','$champs5','$champs6','$champs7','$champs8','$champs9','$champs10','$champs11','$champs12','$champs13','$champs14','$champs15','$champs16','$champs17','$champs18','$champs19','$champs20','$champs21','$champs22','$champs23','$champs24','$champs25','$champs26')");
			$result = $db->query($sql);
		}
	}
	echo "Nombre de lignes importés : ".$cpt;
}
fclose($fp);
?>

