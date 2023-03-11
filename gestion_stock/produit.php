

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
    <form action="produit.php" method="POST">
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

    <div>
        <center>
            <br><br>
            <h3>Ajouter un produit</h3>

            <br><br>
        
        <label for="html">Nom : </label> <input type="text" name="nom">
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prix Unitaire : </label> <input type="number" name="prix">
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantité en stock : </label> <input type="number" name="qte">
        <br><br><br>
        <style>
      input[type=button],
      input[type=submit].blue {
        background-color: #0a2558;
        color:white;
        padding: 8px 15px;
      }
    </style>
        <input type="submit" name="ajouter" value="Ajouter" class="blue">

        <?php include 'db.php'; 

session_start();

ob_start();

        $msg="xxxx";
            if(isset($_POST['ajouter'])){
                $nom=$_POST['nom'];
                $qte=$_POST['qte'];
                $prix=$_POST['prix'];

                if($prix==null ||  $qte==null || $nom==null){
                     $msg='<br>Vous devez entrer tous les informations!!!!';
                     echo $msg;
                }else{
                    $msg='<br>le produit est ajouté';
                    echo $msg;
                    $stmt=$con->prepare("insert into produit(nomproduit,prixunitaire,qtestockee) values('$nom',$prix,$qte);");
                    if($stmt->execute()){
                        echo "done";
                        header("location:home.php");
                    }else{
                        echo "Ressayez !!!!!!!!";
                    }
                }               
            }
        ?>
        <br>
        
        <br><br><br><br>
        <style>
      input[type=button],
      input[type=submit].red {
        background-color: red;
        color:white;
        padding: 8px 15px;
      }
      input[type=button],
      input[type=submit].green {
        background-color: green;
        color:white;
        padding: 8px 15px;
      }
    </style>
        <h3>Les produits existent </h3>
        <br>
        <table border="1" width="83%" align="right">
            <tr>
                <th bgcolor="#0a2558"><center><font color="white">Nom</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Ref</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Prix Unitaire</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Quantité en stock</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Indisponibilité</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Vous pouvez</font></center></th>
            </tr>
<?php
$select_orders = $con->prepare("select *from produit;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
   while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
          
?>
  <tr>
            <td><center><?php echo $row["nomproduit"]; ?></center></td>
            <td><center><?php echo $row["refproduit"]; ?></center></td>
            <td><center><?php echo$row["prixunitaire"]; ?></center></td>
            <td><center><?php echo $row["qtestockee"] ;?></center></td>
            <TD><CENter><?php if($row['indisponible']==1){
              echo 'Indisponible';
            }else{
              echo 'Disponible';
            }
            ?></CENter></TD>
            <TD>
            <CENTER>
            <input type="submit" class="red" VALUE="Supprimer" <?php echo 'name="red'.$row['refproduit'].'"';  ?>>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" class="green" value="modifier" <?php echo 'name="green'.$row['refproduit'].'"'; ?> >
            </CENTER>
            
            </TD>
  </tr>
<?php
}
}
$select_orders = $con->prepare("select *from produit;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
  $supprimer="red".$row['refproduit'];
  if(isset($_POST[$supprimer])){
    $ref=explode("red","red".$row['refproduit']);
    foreach($ref as $i){
      $stmt=$con->prepare("delete from produit where refproduit=".$i.";");
                    if($stmt->execute()){
                      
                      $stmt=$con->prepare("delete from ligne_commande where REFproduit=".$i.";");
                      if($stmt->execute()){
                        echo("done");}
                    }else{
                        echo "Ressayez !!!!!!!!";
                    }
    }
  }
}
}

$select_orders = $con->prepare("select *from produit;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
  $modifier="green".$row['refproduit'];
  if(isset($_POST[$modifier])){
    $ref=explode("green","green".$row['refproduit']);
    foreach($ref as $i){
      $_SESSION["ref"]=$i;
      header("location:ajouter_produit.php"); 
      ob_end_flush();
    }
  } 
}
}
   
?>   
            
            
        </table>
    </div>
    </center>

    
  </body>
</html>

<?php $con=null ?>