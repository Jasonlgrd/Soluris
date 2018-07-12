<?php

$bdd = new PDO('mysql:host=localhost;dbname=soluris;charset=utf8', 'root', 'root');

$reponse = $bdd->query("SELECT * FROM Soluris");

$compteur = 0;

?>
<!--<table>
	<thead>
		<tr>
			<th>Niv.</th>
			<th>N° d'Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
			<th>Statut Appel</th>
		</tr>
	</thead>

	<tbody>-->
<?php

while ($donnee = $reponse->fetch()) {
	$compteur = $compteur+1;
	/*
	?>
	<tr>
		<th>
			<?php
				echo $donnee['Niv.'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['N° d\'appel'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Statut Appel'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Site'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Type de problème'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Symptôme'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Sévérité'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Niveau de blocage'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['date d\'appel'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Priorité'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Date de fin prévue'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Intervenant'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Service'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Tél. demandeur'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Equipe'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Date de cloture'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Intervenant clôture'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Solution'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Date planifiée d\'installation'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Origine de la demande'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Assistant'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Code barre'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['N° de série'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Référence'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Dernière modification'];
			?>
		</th>
		<th>
			<?php
				echo $donnee['Demandeur'];
			?>
		</th>
	</tr>
	<?php
	*/

}

?>
	</tbody>
</table>

<?php
echo "<p>Il y a <strong>".$compteur."</strong> lignes dans la base de données</p>";
?>