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
                        <p>Date début: <input type="text" id="datepicker1"  name="date1"></p>
                        <p>Date fin: <input type="text" id="datepicker2"  name="date2"></p>
                    </div>
                </div>
                </div>
                <br>
                <label>Commentaire à destination de l'emprunteur</label>
                <textarea class="form-control" rows="7" name="text"></textarea>

                <button class="btn btn-info active" type="submit">Proposer</button>
            </div>
        </div>
    </form>
</div>