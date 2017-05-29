<div class="container">
    <form class="well" role="form">
        <div class="row">
            <div class="col-md-8 ">
                <div class="form-group">
                    <label>Jeu du:</label> <!-- aller piocher dans la bdd--><?php echo "jeujeu" ?>
                </div>

                <div class="form-group">
                        <label>Prêté à:</label> <!-- aller piocher dans la bdd--><?php echo "emprunteur" ?>
                </div>
                
                
                 <!-- AVIS -->                   
                <div class="form-group">
                    <label>État du jeu rendu :</label><br>
                    <select class="form-group" name="avisjeu">
                        <option value="1">Déconseille</option>
                        <option value="2">Moyen</option>
                        <option value="3">Recommande</option>
                        <option value="4" selected="selected">Très Bien</option>
                        <option value="5">Excellent</option>
                    </select><br>
                </div>
                <br />
                <!-- Dates a recuperer et stocker dans la bd-->
                <label>Date de réception:</label><input type="text" id="datepicker1"  name="date">
                <br /><br /><br /><br />
                <label>Commentaire a destination de l'emprunteur</label>
                <textarea class="form-control" rows="7"></textarea><br />
                <button class="btn btn-info active" type="submit">Envoyer</button>
            </div>
        </div>
    </form>
</div>