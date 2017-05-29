<div class="container">
    <form class="well" method="post" action = "">
        <div class="row">
            <div class="col-md-16 ">
                <div class="form-group">
                    <label>Demande de prêt à:</label> <!-- aller piocher dans la bdd--><?php echo "prêteur" ?>
                </div>

                <div class="form-group">
                    <label>de son jeu:</label> <!-- aller piocher dans la bdd--><?php echo "jeujeu" ?>
                </div>

                <div class="form-group">
                    <div id="multiple" class="article">
                        <p>Date début: <input type="text" id="datepicker1"  name="date1"></p>
                        <p>Date fin: <input type="text" id="datepicker2"  name="date2"></p>
                    </div>
                </div>

                <br><br>
                <label>Message à destination du prêteur</label>
                <textarea class="form-control" rows="7" name="text"></textarea>
                <input class="btn btn-info active" type="submit">	
            </div>
        </div>
    </form>
</div>