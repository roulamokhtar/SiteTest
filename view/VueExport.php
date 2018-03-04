<?php if(isset ($_POST['export'])) {
header('Content-Type: text/csv;');
header('Content-Disposition: attachement; filename="Export tutoriel.csv"');
?>"Année";"commune";"Localité";"Action";"Source de financement ";"Unité";"Quantité prévue";"Réalisation";"taux physique";"Montant prévu";"Paiement effectué";"taux financier";"Cloture";"Obs"<?php foreach ( $CODE as $actions) {
  echo  "\n".'"'.utf8_decode($actions->annee).'";" '.utf8_decode(stripcslashes($actions->commune)) .'";"'.utf8_decode($actions->localite).'";"'.utf8_decode($actions->nomactions).'";"'.utf8_decode($actions->source_financement).'";"'.utf8_decode($actions->unit).'";"'.number_format($actions->quantite,2,',',' ').'";"'.number_format($actions->realisation_physique, 2, ',', ' ').'";"'.number_format($actions->tauxphysique,2, ',', ' ').'";"'.number_format($actions->montant,2,',',' ').'";"'.number_format($actions->paiement,2,',',' ').'";"'.number_format($actions->tauxpaiemant, 2, ',',' ').'";"'.utf8_decode($actions->cloture).'";"'.utf8_decode($actions->observation).'"';
}
}?>