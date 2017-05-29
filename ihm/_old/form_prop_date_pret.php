<div class="container">
    <form class="well" role="form">
        <div class="row">
            <div class="col-md-8 ">
                <div class="form-group">
                    <label>Nom de l'emprunteur</label> <!-- aller piocher dans la bdd--><?php echo "emprunteur" ?>
                    <br>
                    <label>Nom du jeu</label> <!-- aller piocher dans la bdd--><?php echo "jeujeu" ?>
                </div>
                    <br>
                <div class="form-group">
                    <div id="multiple" class="article">
                                <label>Date début : XXXXXX <br>
                                <label>Date fin : XXXXXX
                    </div>
                </div>
                <br>
                <label>Commentaire a destination de l'emprunteur</label>
                <textarea class="form-control" rows="7" name="text"></textarea>

                <button class="btn btn-info active" type="submit">Accepter</button>
                <button class="btn btn-info active" type="submit">Proposer dates</button>
                <button class="btn btn-info active" type="submit">Refuser</button>
            </div>
        </div>
    </form>
</div>