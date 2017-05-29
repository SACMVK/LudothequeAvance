
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="/ihm/css/bootstrap.min.css">
        <link rel="stylesheet" href="/ihm/css/MUSA_carousel-extended.css">
        <link rel="stylesheet" href="/ihm/css/Navigation-with-Button1.css">
        <link rel="stylesheet" href="/ihm/css/styles.css">

        <title>Ludotheque BTS</title>

        <?php require ('./ihm/pages/effets.php'); ?>
    </head>

    <style>

        #messagerie{
            max-width: 500px;
            width:100%;
            margin:0 auto;
            background-color:#ffffff;
            padding:30px;
            border-radius:4px;
            color:#505e6c;
           box-shadow:1px 1px 5px rgba(0,0,0,0.1);
        }


        h1{
            text-align: center;
        }
        
       .type_msg{
           box-shadow: none;
           border: none;
           background: #f7f9fc;
            display: block;
            width: 100%;
            height:34px;
            padding: 5px 12px;
            
        }
        
        
        .text_msg{
            word-wrap: break-word;  
            
               box-shadow: none;
           border: none;
      
            display: block;
            width: 100%;
            height:200px;
            padding: 5px 12px;
            
        }


    </style>
    <body>



        <div id="messagerie">
            <?php
            //include ('ihm/header/header.php');
//require_once('ihm/menus/menuAdmin.php');//
            // include ('ihm/footer/footer.php');
            include('job/class/message.php');
            include ('job/dao/message_dao.php');
            
               //delete(44); fonctionne 

           
$list['idExped']= 2;
$list['idDest'] = 1;
$list['typeMessage'] = 3;
$list['sujet'] = " un test";
$list['texte'] = " bonjour, ceci est un test pour voir si la fonction insert fonctionne";
              
          // echo insert($list);

            $message1 = array(
                'idExped'=>2, 
                'idDest'=> 2,
                'typeMessage'=> "question",
                'sujet'=> "test",
                'texte'=>"test update",
                'idMessage'=>2);
            
            
              update($message1);

          
           // $list = [$message1, $message2];
          

            include('ihm/pages/message_affichage.php');
            //$afficher_msg = afficher_msg($list);
      
                
           print_r(  afficher_msg(select('select * from message')));

            
        
             


           // echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

            //afficherListeElements($listeMessagesAAfficher);









            /* charlotte : empty ne fonctionne pas car il vérifie si $_GET['page']=null, hors $_GET['page'] n'existe pas
             * in_array ne fonctionne pas non plus, pour une raison indéterminée
             * isset (is set) vérifie non =null mais vérifie si la variable existe ou pas avec une valeur
             */


            /* if (!(isset($_GET['page']))) {
              include('ihm/pages/accueil.php');
              } else {
              include'ihm/pages/' . $_GET['page'] . '.php';
              } */
            ?>
   </div>

        
        
        
        
        
        
        
            
        <script src="../ihm/js/boostrap.js"></script>
        <script src="../ihm/js/jquery-3.1.1.min.js"></script>
        <script src="ihm/js/jquery.min.js"></script>
        <script src="ihm/js/bootstrap.min.js"></script>
        <script src="ihm/js/MUSA_carousel-extended.js"></script>

    </body>


</html>
