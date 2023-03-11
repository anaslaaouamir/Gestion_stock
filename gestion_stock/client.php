

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Client</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <form action="client.php" method="POST">
    <div class="sidebar">
      <div class="logo-details">
        
      </div>
      <ul class="nav-links">
      <div class="sidebar">
      <
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
    <section class="home-section">
      </ul>
    </div>

    <div>
        <center>
            <br><br>
            <h3>Ajouter un Client</h3>

            <br><br>
        
        <label for="html">Nom : </label> <input type="text" name="nom">
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Raison Social : </label> <input type="text" name="rs">
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adresse : </label> <input type="text" name="adresse">
        <br><br><br>
        <label for="html">Ville : </label> <input type="text" name="ville">
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pays : </label> <input type="text" name="pays">
        <label for="html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telephone : </label> <input type="text" name="tele">
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
                $rs=$_POST['rs'];
                $adresse=$_POST['adresse'];
                $ville=$_POST['ville'];
                $pays=$_POST['pays'];
                $tele=$_POST['tele'];

                if($nom==null ||  $rs==null || $adresse==null || $rs==null ||  $pays==null || $ville==null){
                     $msg='<br>Vous devez entrer tous les informations!!!!';
                     echo $msg;
                }else{
                    $ar=str_split($tele);
                    if(count($ar)==10){
                        
                    
                    $stmt=$con->prepare("insert into client(nomclient,raisonsocial,adresseclient,villeclient,pays,telephone) values('$nom','$rs','$adresse','$ville','$pays','$tele');");
                    if($stmt->execute()){
                        $msg='<br>le client est ajouté';
                        echo $msg;
                        header("location:client.php");
                    }else{
                        echo "Ressayez !!!!!!!!";
                    }
                    }else{
                        echo "<br>Numero du Telephone n'est pas correcte";
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
        <h3>Les clients existent </h3>
        <br>
        <table border="1" width="83%" align="right">
            <tr>
                <th bgcolor="#0a2558"><center><font color="white">Numero</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Nom</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Raison Sociale</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Adresse</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Ville</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Pays</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Téléphone</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Vous pouvez</font></center></th>
            </tr>
<?php
$select_orders = $con->prepare("select *from client;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
   while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
          
?>
  <tr>
            <td><center><?php echo $row["numclient"]; ?></center></td>
            <td><center><?php echo $row["nomclient"]; ?></center></td>
            <td><center><?php echo$row["raisonsocial"]; ?></center></td>
            <td><center><?php echo $row["adresseclient"] ;?></center></td>
            <td><center><?php echo $row["villeclient"]; ?></center></td>
            <td><center><?php echo $row["pays"]; ?></center></td>
            <td><center><?php echo$row["telephone"]; ?></center></td>
            <CENTER>
                <td>
                    <center>
            <input type="submit" class="red" VALUE="Supprimer" <?php echo 'name="red'.$row['numclient'].'"';  ?>>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" class="green" value="modifier" <?php echo 'name="green'.$row['numclient'].'"'; ?> >           
            </center>    
        </TD>
            </CENTER>
  </tr>
<?php
}
}
$select_orders = $con->prepare("select *from client;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
  $supprimer="red".$row['numclient'];
  if(isset($_POST[$supprimer])){
    $stmt1=$con->prepare("INSERT into archive(numcommande,numclient,prix_unitaire,qtecommandee,refproduit,nomclient)  select c.numcommande,c.numclient,p.prixunitaire,lc.qtecommandee,p.refproduit,cl.nomclient
    from CLIENT cl,commande c,ligne_commande lc,produit p where cl.numclient=c.numclient and c.numcommande=lc.numcommande and lc.refproduit=p.refproduit and cl.numclient=".$row['numclient'].";");
    
    if($stmt1->execute()){
      echo("done");
  }else{
      echo "Ressayez ??!";
  }
      $stmt=$con->prepare("delete from client where numclient=".$row['numclient'].";");
                    if($stmt->execute()){
                      
                    }else{
                        echo "Ressayez !!!!!!!!";
                    }
                    
  }
  
}
}

$select_orders = $con->prepare("select *from client;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
  $modifier="green".$row['numclient'];
  if(isset($_POST[$modifier])){
    $numclient=explode("green","green".$row['numclient']);
    foreach($numclient as $i){
      $_SESSION["numclient"]=$i;
      header("location:modifier_client.php"); 
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