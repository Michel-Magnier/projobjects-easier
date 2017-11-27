<?php

// Autoload PSR-4
spl_autoload_register();

// Imports 
use \Classes\Webforce3\Config\Config;
use \Classes\Webforce3\DB\Country;
use \Classes\Webforce3\Helpers\SelectHelper;

// Get the config object
$conf = Config::getInstance();

$countryId = isset($_GET['cou_id']) ? intval($_GET['cou_id']) : 0;
$countryObject = new Country();

// Récupère la liste complète des country en DB
$countriesList = Country::getAllForSelect();

// Si modification d'une ville, on charge les données pour le formulaire
if ($countryId > 0) {
	$countryObject = Country::get($countryId);
        echo "<br>Je recupere l'objet Country :<br>";
        print_r($countryObject);
}

// Si lien suppression
if (isset($_GET['delete']) && intval($_GET['delete']) > 0) {
	if (Country::deleteById(intval($_GET['delete']))) {
		header('Location: country.php?success='.urlencode('Suppression effectuée'));
		exit;
	}
}

// Formulaire soumis
if(!empty($_POST)) {
	$countryId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $countryName = isset($_POST['cou_name']) ? trim($_POST['cou_name']) : '';

    if (empty($countryName)) {
		$conf->addError('Veuillez renseigner le nom');
	}
    
    // je remplis l'objet qui est lu pour les inputs du formulaire, ou pour l'ajout en DB
	$countryObject = new Country(
		$countryId,
		$countryName
	);
    
    // Si tout est ok => en DB
	if (!$conf->haveError()) {
		if ($countryObject->saveDB()) {
			header('Location: country.php?success='.urlencode('Ajout/Modification effectuée').'&cou_id='.$countryObject->getId());
			exit;
		}
		else {
			$conf->addError('Erreur dans l\'ajout ou la modification');
		}
	}
}

$selectCountries = new SelectHelper($countriesList, $countryId, array(
	'name' => 'cou_id',
	'id' => 'cou_id',
	'class' => 'form-control',
));

// Views - toutes les variables seront automatiquement disponibles dans les vues
require $conf->getViewsDir().'header.php';
require $conf->getViewsDir().'country.php';
require $conf->getViewsDir().'footer.php';