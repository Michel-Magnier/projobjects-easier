<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Sélection</div>
    <div class="panel-body">
        <?php include 'alerts.php'; ?>
        <form action="" method="get">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php $selectCountries->displayHTML(); ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="submit" class="btn btn-success btn-block" value="Sélectionner" />
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="?" class="btn btn-info btn-block">Ajouter</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading"><strong>COUNTRY</strong> <?php if ($countryObject->getId() > 0) : ?>Modification<?php else : ?>Ajout<?php endif ?></div>
    <div class="panel-body">
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $countryObject->getId() ?>">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="cou_name">Nom</label>
                        <input type="text" class="form-control" name="cou_name" id="cou_name" placeholder="Nom" value="<?= $countryObject->getName() ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="submit" class="btn btn-success btn-block" value="Valider" />
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="?delete=<?= $countryObject->getId() ?>" class="btn btn-warning btn-block<?php if ($countryObject->getId() <= 0) : ?> disabled<?php endif; ?>" role="button" aria-disabled="true">Supprimer</a>
                </div>
            </div>
        </form>
    </div>
</div>