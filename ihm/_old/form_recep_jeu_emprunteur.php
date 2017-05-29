<div class="container">
    <form class="well">
	<div class="row">
            <div class="col-md-16 ">
                
                
                
                <!-- Infos preteur/emprunteur -->
                <div class="form-group">
                    <label>Jeu du:</label> <!-- aller piocher dans la bdd--><?php echo "jeujeu" ?>
                </div>
                
                <div class="form-group">
                    <label>Emprunté à:</label> <!-- aller piocher dans la bdd--><?php echo "prêteur" ?>
                </div>
                
                
                
		<!-- etat du jeu existant dans la bd ==> aller piocher dans la bd -->
                
                <div class="form-group">
                    <label>État du jeu reçu :</label><br>
                    XXXXXXX
                </div>                
                
                
		<!-- Dates debut/fin de pret-->
                
                <div class="form-group">
                    <div id="multiple" class="article">
                        <p>Date de réception: &nbsp;&nbsp;<input type="text" id="datepicker1"  name="date1"></p>
                    </div>
                </div>
                
                
                <label>Commentaire a destination de l'emprunteur</label>
                    <textarea class="form-control" rows="7" name="com_emp"></textarea>
                    <br />
                    
                    <button class="btn btn-info active" type="submit">Envoyer</button>
                    
            </div>
        </div>
    </form>
</div>