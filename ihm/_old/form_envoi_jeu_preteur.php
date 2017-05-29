<div class="container">
    <form class="well" role="form">
        <div class="row">
            <div class="col-md-8 ">
                <div class="form-group">
                    <br><br><br>
                        <label>Jeu du :</label> <!-- aller piocher dans la bdd--><?php echo "jeujeu" ?>
                        <br>
                        <label>Emprunté à</label> <!-- aller piocher dans la bdd--><?php echo "prêteur" ?>
                </div> <br>
                <div class="form-group">
                    <div id="multiple" class="article">
                        <label>Date d'envoi : </label> <input type="text" id="datepicker1"  name="date">
                    </div>
                </div>
                <br><br /><br />
                <label>Commentaire à destination de l'emprunteur</label>
                <textarea class="form-control" rows="7" name="text"></textarea> <br />
                <button class="btn btn-info active" type="submit">Envoyer</button>
            </div>
        </div>
    </form>
</div>