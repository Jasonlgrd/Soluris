<?php
/*-----------------------------------*/
/*------------HEADER-----------------*/
include 'H&F/header.php';
/*-----------------------------------*/

//-----------ACTION-----------------
if(isset($_GET['action'])){
    $action=$_GET['action'];
} else {
    $action='';
}
//--------PAGE POUR SE CONNECTER-------
if($action=='import')
{
	include 'pages/formulaire_import.php';
}
if($action=='requete_import')
{
	include 'pages/import.php';
}


if($action=='graphique')
{
	include 'pages/formulaire_graphique.php';
}
if($action=='affiche_graphique')
{
	include 'pages/affiche_graphique.php';
}

if($action=='affichebdd')
{
	include 'pages/contenu_bdd.php';
}

//Quand ensemble vide
elseif($action=='')
{
    include 'pages/accueil.php';
}

/*-----------------------------------*/
/*-------------FOOTER----------------*/
include 'H&F/footer.php';
/*-----------------------------------*/

?>