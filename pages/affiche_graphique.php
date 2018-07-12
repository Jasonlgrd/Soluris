<?php
$ListeRequete="<span style=\"text-decoration:underline\">REQUETE :</span> <br />";
/*---------------------------------------------------------------------------*/
/*                              RECUPERATION DE LA DATE                      */
/*---------------------------------------------------------------------------*/
if (!empty($_POST['date_debut'])) {
	//CONVERSTION EN DATE
	list( $jour, $mois, $annee ) = explode( '/', $_POST['date_debut'] );
	$newDateDebut = $annee .'-'. $mois .'-'. $jour;
	//--------------------------------------------------------
	$date_debut = '`Date d\'appel`>='."'".$newDateDebut."'";
	$ListeRequete = $ListeRequete."Date de début : ".$_POST['date_debut']."<br />";
} else {
	$date_debut = '`Date d\'appel`>='."'0000-00-00'";
	$ListeRequete = $ListeRequete."Date de début : Aucune date sélectionné <br />";
};
if (!empty($_POST['date_fin'])) {
	//CONVERSTION EN DATE
	list( $jour, $mois, $annee ) = explode( '/', $_POST['date_fin'] );
	$newDateFin = $annee .'-'. $mois .'-'. $jour;
	//--------------------------------------------------------
	$date_fin = '`Date d\'appel`<='."'".$newDateFin."'";
	$ListeRequete = $ListeRequete."Date de fin : ".$_POST['date_fin']."<br />";
} else {
	$date_fin = '`Date d\'appel`<='."'9999-99-99'";
	$ListeRequete = $ListeRequete."Date de fin : Aucune date sélectionné <br />";
};

/*---------------------------------------------------------------------------*/
/*                              RECUPERATION DES SITES                       */
/*---------------------------------------------------------------------------*/
$cptSite=0;
$nbSite=1;
$site = "";
while ($cptSite!=1) {
	if (empty($_POST['site'.$nbSite.''])) {
		if ($site!=NULL) {
			# code...
		} else {
			$site = "";
			$ListeRequete = $ListeRequete."Sites : Tous";
		}
		$cptSite=1;
	}
	if (!empty($_POST['site'.$nbSite.'']) && $nbSite==1) {
		$site = ' AND `Site`='."'".$_POST['site'.$nbSite.'']."'";
		$site=str_replace("\\", "\\\\", $site);
		$ListeRequete = $ListeRequete."Sites : ".$_POST['site'.$nbSite.''];
		$nbSite=$nbSite+1;
	}
	if (!empty($_POST['site'.$nbSite.'']) && $nbSite>1) {
		$siteTemp = ' OR `Site`='."'".$_POST['site'.$nbSite.'']."'";
		$siteTemp=str_replace("\\", "\\\\", $siteTemp);
		$site = $site.$siteTemp;
		$ListeRequete = $ListeRequete." ; ".$_POST['site'.$nbSite.''];
		$nbSite=$nbSite+1;
	}
}

/*---------------------------------------------------------------------------*/
/*                              RECUPERATION DE L'EQUIPE                     */
/*---------------------------------------------------------------------------*/
if (isset($_POST['equipe'])) {
	if ($_POST['equipe']=="TOUS") {
		$equipe = "";
		$ListeRequete = $ListeRequete."<br /> Equipe : Tous<br />";
	} else {
		$equipe = ' AND `Equipe`='."'".str_replace("'", "\\'",$_POST['equipe'])."'";
		$ListeRequete = $ListeRequete."<br /> Equipe : ".$_POST['equipe']."<br />";
	}
};

/*---------------------------------------------------------------------------*/
/*                          RECUPERATION DU TYPE DE PROBLEME                 */
/*---------------------------------------------------------------------------*/
if (isset($_POST['type_de_probleme_niv1'])) {
	if ($_POST['type_de_probleme_niv1']=="TOUS") {
		$type_de_probleme = "";
		$ListeRequete = $ListeRequete."Type de problème : Tous";
	} else {
		$type_de_probleme = ' AND `Type de problème` LIKE '."'".$_POST['type_de_probleme_niv1']."%'";
		$ListeRequete = $ListeRequete."Type_probleme : ".$_POST['type_de_probleme_niv1'];
	}

	if (isset($_POST['type_de_probleme_niv2'])) {
		if ($_POST['type_de_probleme_niv2']=="TOUS") {
			# code...
		} else {
			$type_de_probleme = substr($type_de_probleme,0,-2)."\\\\\\\\".$_POST['type_de_probleme_niv2']."%'";
			$ListeRequete = $ListeRequete."/".$_POST['type_de_probleme_niv2'];
		}

		if (isset($_POST['type_de_probleme_niv3'])) {
			if ($_POST['type_de_probleme_niv3']=="TOUS") {
				# code...
			} else {
				$type_de_probleme = substr($type_de_probleme, 0,-2)."\\\\\\\\".$_POST['type_de_probleme_niv3']."%'";
				$ListeRequete = $ListeRequete."/".$_POST['type_de_probleme_niv3'];
			}
		};
	};
};

/*---------------------------------------------------------------------------*/
/*                         RECUPERATION DU TYPE DE GRAPHIQUE                 */
/*---------------------------------------------------------------------------*/
if (isset($_POST['graphique'])) {
	$graphique = $_POST['graphique'];
};

if (isset($_POST['SelectStat'])) {
	$stats = $_POST['SelectStat'];
};

/*---------------------------------------------------------------------------*/
/*                                      REQUETE                              */
/*---------------------------------------------------------------------------*/
$connexion = mysqli_connect("localhost","root","root","soluris");
$requete = mysqli_query($connexion,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$requetesql="SELECT Site,`Date d'appel`,`Type de problème`,Equipe FROM Soluris WHERE $date_debut AND $date_fin $site $equipe $type_de_probleme";
$requete = mysqli_query($connexion,$requetesql);
echo $ListeRequete;
/*---------------------------------------------------------------------------*/
/*                      RECUP DES DONNEES DANS UN TABLEAU                    */
/*---------------------------------------------------------------------------*/
$data = array();
$nombre_de_lignes = 0;

while ($row = mysqli_fetch_row($requete))
{
	$data[] = $row;
	$nombre_de_lignes = $nombre_de_lignes + 1;
}
json_encode($data);
?>

<!-- ______________________________________________________________________ -->
<!--                                   HTML                                 -->
<!-- ______________________________________________________________________ -->

<div id="graphiqueSite" ></div>
<div id="graphiqueEquipe" ></div>
<div id="graphiqueTypeProbleme" ></div>

<div id="affichedonnee"></div>

<script type="text/javascript">
/*---------------------------------------------------------------------------*/
/*                                 JAVASCRIPT                                */
/*---------------------------------------------------------------------------*/
$(document).ready(function(){

	var tab = <?php echo json_encode($data) ?>;
	/*-----------------------------------------------------------*/
	/*                  GRAPHIQUE POUR LES SITE                  */
	/*-----------------------------------------------------------*/
	if ("<?php echo $stats; ?>" == "site") {
		var ListeSite = [];
		var data = []
		for (var i in tab){
			row = tab[i];

			var Site = row[0];

			if (ListeSite.indexOf(Site) === -1) {
				ListeSite.push(Site);
				var nbLigneSite=0;
				for (var i in tab){
					ligne = tab[i];
					if (ligne[0] == Site) {
						nbLigneSite = nbLigneSite +1;
					}
				}
				var ajoutObjet = {name: Site, y: nbLigneSite};
				data.push(ajoutObjet);
			}
		}

		$('#graphiqueSite').highcharts({
			chart: {
		        type: '<?php echo $graphique; ?>'
		    },
		    title: {
		        text: 'Stats Site'
		    },
		    series: [{data}]
		});
	}
	/*-----------------------------------------------------------*/
	/*                 GRAPHIQUE POUR LES EQUIPES                */
	/*-----------------------------------------------------------*/
	if ("<?php echo $stats; ?>" == "equipe") {
		var ListeEquipe = [];
		var data = []
		for (var i in tab){
			row = tab[i];

			var Equipe = row[3];

			if (ListeEquipe.indexOf(Equipe) === -1) {
				ListeEquipe.push(Equipe);
				var nbLigneEquipe=0;
				for (var i in tab){
					ligne = tab[i];
					if (ligne[3] == Equipe) {
						nbLigneEquipe = nbLigneEquipe +1;
					}
				}
				var ajoutObjet = {name: Equipe, y: nbLigneEquipe};
				data.push(ajoutObjet);
			}
		}

		$('#graphiqueEquipe').highcharts({
			chart: {
		        type: '<?php echo $graphique; ?>'
		    },
		    title: {
		        text: 'Stats Equipe'
		    },
		    series: [{data}]
		});	
	}
	/*-----------------------------------------------------------*/
	/*                GRAPHIQUE POUR TYPE DE PROBLEME            */
	/*-----------------------------------------------------------*/
	if ("<?php echo $stats; ?>" == "typeprobleme") {
		var ListeTypeProbleme = [];
		var data = [];
		var Donnee = []
		for (var i in tab){
			row = tab[i];

			var Type_probleme = row[2];

			if (ListeTypeProbleme.indexOf(Type_probleme) === -1) {
				ListeTypeProbleme.push(Type_probleme);
				var nbLigneTypeProbleme=0;
				for (var i in tab){
					ligne = tab[i];
					if (ligne[2] == Type_probleme) {
						nbLigneTypeProbleme = nbLigneTypeProbleme +1;
					}
				}
				var ajoutObjet = {name: Type_probleme, y: nbLigneTypeProbleme};
				data.push(ajoutObjet);
			}
		}

		$('#graphiqueTypeProbleme').highcharts({
			chart: {
		        type: '<?php echo $graphique; ?>'
		    },
		    title: {
		        text: 'Stats Type de Probleme'
		    },
		    series: [{data}]
		});
	}
	/*-----------------------------------------------------------*/
});
</script>