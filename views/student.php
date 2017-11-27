<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Sélection</div>
    <div class="panel-body">
        <?php include 'alerts.php'; ?>
        <form action="" method="get">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php $selectStudents->displayHTML(); ?>
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
    <div class="panel-heading"><strong>STUDENT</strong> <?php if ($studentObject->getId() > 0) : ?>Modification<?php else : ?>Ajout<?php endif ?></div>
    <div class="panel-body">
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $studentObject->getId() ?>">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="stu_lname">Nom</label>
                        <input type="text" class="form-control" name="stu_lname" id="stu_lname" placeholder="Nom" value="<?= $studentObject->getLname() ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="stu_fname">Prénom</label>
                        <input type="text" class="form-control" name="stu_fname" id="stu_fname" placeholder="Prénom" value="<?= $studentObject->getFname() ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="form-group">
                        <label for="stu_email">Email</label>
                        <input type="email" class="form-control" name="stu_email" id="stu_email" placeholder="Email" value="<?= $studentObject->getEmail() ?>">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="stu_birthdate">Date de naissance</label>
                        <input type="date" class="form-control" name="stu_birthdate" id="stu_birthdate" placeholder="YYYY-MM-DD" value="<?= $studentObject->getBirthdate() ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="stu_friendliness">Sympathie</label>
                        <?php $selectFriendliness->displayHTML(); ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="ses_id">Session de formation</label>
                        <?php $selectSessions->displayHTML(); ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="stu_friendliness">Ville</label>
                        <?php $selectCities->displayHTML(); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="submit" class="btn btn-success btn-block" value="Valider" />
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="?delete=<?= $studentObject->getId() ?>" class="btn btn-warning btn-block<?php if ($studentObject->getId() <= 0) : ?> disabled<?php endif; ?>" role="button" aria-disabled="true">Supprimer</a>
                </div>
            </div>
        </form>
    </div>
</div>