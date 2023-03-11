

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Produit</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <form action="modifier_client.php" method="POST">
    <div class="sidebar">
      <div class="logo-details">
        
      </div>
      <ul class="nav-links">
        <li>
          <a href="home.php" class="active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="produit.php">
            <i class="bx bx-box"></i>
            <span class="links_name">Produit</span>
          </a>
        </li>
        <li>
          <a href="commande.php">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Commandes</span>
          </a>
        </li>
        <li>
          <a href="client.php">
            <i class="bx bx-user"></i>
            <span class="links_name">Client</span>
          </a>
        </li>
        
      </ul>
    </div>
    <style>
      input[type=button],
      input[type=submit].blue {
        background-color: #0a2558;
        color:white;
        padding: 8px 15px;
      }
    </style>
    <div>
        <center>
            <br><br>
            <h3>Modifer un Client</h3>

            <br><br>
        
        <?php 
        include 'db.php';
            session_start();
            $numclient=$_SESSION['numclient'];
            $select_orders = $con->prepare("select *from client where numclient=".$numclient.";");
$select_orders->execute();

if($select_orders->rowCount() > 0){
while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
        ?>
        <label for="html">Nom : </label> <input type="text" name="nom" <?php echo 'value="'.$row['nomclient'].'"'; ?>>
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Raison Sociale: </label> <input type="text" name="rs" <?php echo 'value="'.$row['raisonsocial'].'"'; ?>>
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adresse : </label> <input type="text" name="adresse" <?php echo 'value="'.$row['adresseclient'].'"'; ?>>        
        <br><br><br>
        <label for="html">Ville : </label> <input type="text" name="ville" <?php echo 'value="'.$row['villeclient'].'"'; ?>>
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pays: </label> <input type="text" name="pays" <?php echo 'value="'.$row['pays'].'"'; ?>>
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Téléphone: </label> <input type="text" name="tele" <?php echo 'value="'.$row['telephone'].'"'; ?>>        
        <br><br><br>
        <input type="submit" name="modifier" value="Modifer" class="blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="annuler" value="Annuler" class="blue">
        <?php  
}}
$msg="";
            if(isset($_POST['modifier'])){
              $nom=$_POST['nom'];
              $rs=$_POST['rs'];
              $adresse=$_POST['adresse'];
              $ville=$_POST['ville'];
              $pays=$_POST['pays'];
              $tele=$_POST['tele'];
                
                if($nom==null ||  $rs==null || $adresse==null || $rs==null ||  $pays==null || $ville==null){
                     $msg='<br>Vous devez saisir tous les informations!!!!';
                     echo $msg;
                }else{
                  $ar=str_split($tele);
                  if(count($ar)==10){
                    echo $msg;
                    $stmt=$con->prepare("update client set nomclient='".$nom."' ,raisonsocial='".$rs."' ,adresseclient='".$adresse."'
                    ,villeclient='".$ville."' ,pays='".$pays."',telephone='".$tele."' where numclient=".$numclient.";");
                    echo "update client set nomclient='".$nom."' ,raisonsocial='".$rs."' ,adresseclient='".$adresse."'
                    ,villeclient='".$ville."' ,pays='".$pays."',telephone='".$tele."' where numclient=".$numclient.";";
                    if($stmt->execute()){
                        echo "done";
                        header("location:client.php");
                    }else{
                        echo "Ressayez !!!!!!!!";
                    }
                }  
              }             
            }
            if(isset($_POST['annuler'])){
                header("location:client.php");
            }
        ?>
    </center>

</div>
  </body>
</html>

<?php $con=null ?>