<div class="container">
    <form class="well" role="form">
        <div class="row">
            <div class="col-md-8 ">
                <div class="form-group">
                    <label>Nom du prêteur</label> <!-- aller piocher dans la bdd--><?php echo "prêteur" ?>
                    <br>
                    <label>Nom du jeu</label> <!-- aller piocher dans la bdd--><?php echo "jeujeu" ?>
                </div>
                    <br>
                <div class="form-group">
                    <div id="multiple" class="article">
                                <label>Date début : XXXXXX</label> <br>
                                <label>Date fin : XXXXXX</label><br>
                    </div>
                </div>
                <br>
                <label>Commentaire a destination du prêteur:</label>
                <textarea class="form-control" rows="7" name="text"></textarea>

                <button class="btn btn-info active" type="submit">Accepter</button>
                <button class="btn btn-info active" type="submit">Refuser</button>
            </div>
        </div>
    </form>
</div>