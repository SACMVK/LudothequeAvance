<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $individu->getPrenom() ?> <?= $individu->getNom() ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt=" " class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 "> 
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Pseudo : </td>
                                        <td> <?= $individu->getPseudo() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nom :</td>
                                        <td><?= $individu->getNom() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Prenom :</td>
                                        <td><?= $individu->getPrenom() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email :</td>
                                        <td><a href="mailto:<?= $individu->getEmail() ?>"><?= $individu->getEmail() ?></a></td>
                                    </tr>

                                    <tr>
                                        <td>date d inscription :</td>
                                        <td>'<?= $individu->getDateInscription() ?></td>
                                    </tr>
                                    <tr>
                                        <td>date de naissance :</td>
                                        <td><?= $individu->getDateNaissance() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Rue :</td>
                                        <td><?= $individu->getRue() ?></td>
                                    </tr>
                                    <tr>
                                        <td>ville :</td>
                                        <td><?= $individu->getVille() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Departement :</td>
                                        <td><?= $individu->getDept() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Code Postal :</td>
                                        <td><?= $individu->getCodePostal() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tel :</td>
                                        <td><?= $individu->getTelephone() ?><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> 
