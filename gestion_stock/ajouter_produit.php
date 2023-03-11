

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
    <form action="ajouter_produit.php" method="POST">
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
            <span class="links_name">Clients</span>
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
            <h3>Modifer un produit</h3>

            <br><br>
        
        <?php 
        include 'db.php';
            session_start();
            $ref=$_SESSION['ref'];
            $select_orders = $con->prepare("select *from produit where refproduit=".$ref.";");
$select_orders->execute();

if($select_orders->rowCount() > 0){
while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
        ?>
        <label for="html">Nom : </label> <input type="text" name="nom" <?php echo 'value="'.$row['nomproduit'].'"'; ?>>
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prix Unitaire : </label> <input type="number" name="prix" <?php echo 'value="'.$row['prixunitaire'].'"'; ?>>
        <br><br><label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantité en stock : </label> <input type="number" name="qte" <?php echo 'value="'.$row['qtestockee'].'"'; ?>> 
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Disponibilite :</label><input list="dispo" name="dispo"/> 
<datalist id="dispo" value="Disponible">
<option value="Disponible"></option><option value="Indisponible"></option>
</datalist>
        <br><br><br>
        <input type="submit" name="modifier" value="Modifer" class="blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="annuler" value="Annuler" class="blue">
        <?php  
}}
$msg="";
            if(isset($_POST['modifier'])){
                $nom=$_POST['nom'];
                $qte=$_POST['qte'];
                $prix=$_POST['prix'];
                $dispo=$_POST['dispo'];
                
                if($prix==null ||  $qte==null || $nom==null || $dispo==null){
                     $msg='<br>Vous devez entrer tous les informations!!!!';
                     echo $msg;
                }else{
                    echo $msg;
                    if($dispo=="Disponible"){
                      $dispo_number=0;
                    }else{
                      $dispo_number=1;
                    }
                    $stmt=$con->prepare("update produit set nomproduit='".$nom."' ,prixunitaire=".$prix." ,qtestockee=".$qte.",indisponible='".$dispo_number."' where refproduit=".$ref.";");
                    //echo "update produit set nomproduit='".$nom."' ,prixunitaire=".$prix." ,qtestockee=".$qte.",indisponible='".$dispo_number."' where refproduit=".$ref.";";
                    if($stmt->execute()){
                        echo "done";
                        header("location:produit.php");
                    }else{
                        echo "Ressayez !!!!!!!!";
                    }
                }               
            }
            if(isset($_POST['annuler'])){
                header("location:produit.php");
            }
        ?>
    </center>

</div>
  </body>
</html>

<?php $con=null ?>