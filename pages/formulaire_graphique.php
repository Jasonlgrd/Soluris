<?php
$bdd = new PDO('mysql:host=localhost;dbname=soluris;charset=utf8', 'root', 'root');
$reponse = $bdd->query("SELECT DISTINCT Equipe FROM Soluris");
$reponse2 = $bdd->query("SELECT DISTINCT `Type de problème` FROM Soluris");
$liste1_TPD = array();
array_push($liste1_TPD, "TOUS");
while ($donnee = $reponse2->fetch()) {
	$position_antislash=strpos($donnee['Type de problème'],"\\");
	$chaine=substr($donnee['Type de problème'], 0, $position_antislash);
	if (!empty($chaine)) {
		if (in_array($chaine, $liste1_TPD)) {
		# code...
		} else {
			array_push($liste1_TPD, $chaine);
		}
	}
}
?>

<h1>Génération de Graphique</h1>

<form method="POST" action="index.php?action=affiche_graphique" >

	<label>Date de début</label>
	<input type="date" name="date_debut" placeholder="--/--/----">
	<label> / Date de fin</label>
	<input type="date" name="date_fin" placeholder="--/--/----">

	<hr />


	<label>Site :</label>
	<p>Attention : vérifier la saisie avant de cliquer sur Ajouter un site</p>
	<!-- <input type="text" name="site" id="site" onkeyup="pressclavier()" >-->
	<div id="ajoutsite"></div>
	<a onclick="ajoutsite()">Ajouter un site</a>
	<div id="listesites"></div>

	<hr />

	<label>Equipe</label>
	<select id="equipe" name="equipe">
		<?php
		$cpt=1;
		if ($cpt===1) {
			echo "<option>TOUS</option>";
			$cpt=0;
		}
		while ($donnee = $reponse->fetch()) {
			echo "<option>".$donnee['Equipe']."</option>";
		}
		?>
	</select>

	<hr />

	<label>Type de problème</label>
	<select id="premierSelect" name="type_de_probleme_niv1">
		<?php
		foreach ($liste1_TPD as $value) {
			echo "<option>".$value."</option>";
		}
		?>
	</select>
	<select id="deuxiemeSelect" name="type_de_probleme_niv2">
	</select>
	<select id="troisiemeSelect" name="type_de_probleme_niv3">
	</select>

	<hr />

	<label>Graphique :</label>
	<select id="graphique" name="graphique">
		<option value="pie" >Camembert</option>
		<option value="line" >Ligne</option>
		<option value="column" >Colonne</option>
	</select>

	<hr />

	<label>Votre statistique : </label><br />
	<span>Stats Site</span><input type="radio" name="SelectStat" value="site" checked=""><br />
	<span>Stats Equipe</span><input type="radio" name="SelectStat" value="equipe"><br />
	<span>Stats Type de problème</span><input type="radio" name="SelectStat" value="typeprobleme">

	<hr />

	<input type="submit" name="envoyer">
</form>

<script type="text/javascript">
var cpt=1;
function ajoutsite(){
	$("#ajoutsite").append("<input type=\"text\" name=\"site"+cpt+"\" id=\"site"+cpt+"\" onkeyup=\"pressclavier()\" ><br />");
};

	function pressclavier(){
		var valeur = document.getElementById("site"+cpt+"").value;

		$.ajax({
			url: 'Requetes/requeteSite.php',
			type: 'GET',
			data: 'debut=' + valeur,
			dataType: 'json',
			success: function(data){
				$("#listesites").html("");
				for (var i in data) {

					var str = data[i];
					var res = str.replace("\\","1");
					var res = res.replace("\'","\\\'");

					var array = [];
					array.push(res);

					$("#listesites").append('<input type="button" id="bouton" value="'+data[i]+'" onclick="rempli(\''+res+'\')" ><br>');
				}
			}
		});
	};

	function rempli(data){
		document.getElementById("site"+cpt+"").value = "";
		data = data.replace("1","\\")
		document.getElementById("site"+cpt+"").value = data;
		$("#listesites").html("");
		cpt=cpt+1;
	};



	$(document).ready(function(){

		$("#deuxiemeSelect").hide();
		$("#troisiemeSelect").hide();

		document.getElementById("premierSelect").onchange = function() {

			var donnee=document.getElementById("premierSelect").value;
				
			$.ajax({
				url: 'Requetes/requeteSelect2.php',
				type: 'GET',
				data: 'niv1=' + donnee,
				dataType: 'json',
				success: function(data){

					var oSelect = document.getElementById('deuxiemeSelect');
					if (oSelect!=null) {
						oSelect.options.length=0;
						var opts = oSelect.getElementsByTagName('type_de_probleme_niv2');
						for (var i = 0; i < opts.length; i++) {
						    oSelect.removeChild(opts[i]);
						}
					}
        			
					var select = document.getElementById ("deuxiemeSelect");
					select.options[select.options.length] = new Option ("TOUS", "TOUS");
					for (var i in data) {
						
    					select.options[select.options.length] = new Option (data[i], data[i]);
					}
				}
			});
			$("#deuxiemeSelect").show();
		};

		document.getElementById("deuxiemeSelect").onchange = function() {

			var donnee1=document.getElementById("deuxiemeSelect").value;

			$.ajax({
				url: 'Requetes/requeteSelect3.php',
				type: 'GET',
				data: 'niv2=' + donnee1,
				dataType: 'json',
				success: function(data){

					var oSelect2 = document.getElementById('troisiemeSelect');
					if (oSelect2!=null) {
						oSelect2.options.length=1;
						var opts = oSelect2.getElementsByTagName('type_de_probleme_niv3');
						for (var i = 0; i < opts.length; i++) {
						    oSelect2.removeChild(opts[i]);
						}
					}

					var select1 = document.getElementById ("troisiemeSelect");
					select1.options[select1.options.length] = new Option ("TOUS", "TOUS");
					for (var i in data) {
    					select1.options[select1.options.length] = new Option (data[i], data[i]);
					}
				}
			});
			$("#troisiemeSelect").show();
		};

	});
</script>