

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Commande</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <form action="commande.php" method="POST">
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
          <a href="#">
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
      input[type=button],
      input[type=submit].blue {
        background-color: #0a2558;
        color:white;
        padding: 8px 15px;
      }
    </style>
    
<?php      include 'db.php';
ob_start();
      session_start();?>
    <div>
        <center>
            <br><br>
            <h3>Gestion Des Commande</h3>

            
        <br><br>
        <label for="html">Nom du client à cherché : </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="nom">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="chercher_nom" value="chercher" class="blue">
        <br><br>
        <label for="html">Numero du client à cherché : </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="number" name="numclient">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        <input type="submit" name="chercher_num" value="chercher" class="blue">
        <br><br> <br>
        <label for="html">Les commandes lister par client :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="all_cmd_client" value="Voir" class="blue">
        <br><br>
        <label for="html">Toutes les commandes existent : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="all_cmd" value="Voir" class="blue">
        <br><br>
        
      <?php 

            if(isset($_POST['chercher_nom'])) {
                if($_POST['nom']==null){
                    echo '<br> Vous devez saisir le nom';
                }else{
                    $select_orders = $con->prepare("select *from client where nomclient like '".$_POST['nom']."%';");
$select_orders->execute();
if($select_orders->rowCount() > 0){
    ?>

<table border="1" width="83%" align="right">
            <tr>
                <th bgcolor="#0a2558"><center><font color="white">Numero</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Nom</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Raison Sociale</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Adresse</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Ville</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Pays</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Téléphone</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Gestion commande</font></center></th>
            </tr>

<?php
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
            <input type="submit" class="blue" value="Ajouter" <?php echo 'name="green'.$row['numclient'].'"'; ?> >           
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" class="blue" value="Voir" <?php echo 'name="voir'.$row['numclient'].'"'; ?> >  
          </center>    
        </TD>
            </CENTER>
  </tr>
     <?php               
                }
            }else{
                echo 'Aucun Client existe';
            }
        }}


        if(isset($_POST['all_cmd_client'])){  
    $select_orders = $con->prepare("select *from client ;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
?>

<table border="1" width="83%" align="right">
      <tr>
          <th bgcolor="#0a2558"><center><font color="white">Numero</font></center></th>
          <th bgcolor="#0a2558"><center><font color="white">Nom</font></center></th>
          <th bgcolor="#0a2558"><center><font color="white">Raison Sociale</font></center></th>
          <th bgcolor="#0a2558"><center><font color="white">Adresse</font></center></th>
          <th bgcolor="#0a2558"><center><font color="white">Ville</font></center></th>
          <th bgcolor="#0a2558"><center><font color="white">Pays</font></center></th>
          <th bgcolor="#0a2558"><center><font color="white">Téléphone</font></center></th>
          <th bgcolor="#0a2558"><center><font color="white">Gestion commande</font></center></th>
      </tr>

<?php
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
      <input type="submit" class="blue" value="Ajouter" <?php echo 'name="green'.$row['numclient'].'"'; ?> >           
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" class="blue" value="Voir" <?php echo 'name="voir'.$row['numclient'].'"'; ?> >  
    </center>    
  </TD>
      </CENTER>
</tr>

<?php               
          }
      }else{
          echo 'Aucun Client existe';
      }
    }

        if(isset($_POST['chercher_num'])){
            if($_POST['numclient']==null){
                echo 'Vous devez saisir le numero du client';
            }else{
                $select_orders = $con->prepare("select *from client where numclient=".$_POST['numclient'].";");
$select_orders->execute();
if($select_orders->rowCount() > 0){

    ?>
<table border="1" width="83%" align="right">
            <tr>
                <th bgcolor="#0a2558"><center><font color="white">Numero</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Nom</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Raison Sociale</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Adresse</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Ville</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Pays</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Téléphone</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Gestion commande</font></center></th>
            </tr>


    <?php  while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
     ?> 
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
            <input type="submit" class="green" value="Ajouter" <?php echo 'name="green'.$row['numclient'].'"'; ?> >
            <input type="submit" class="green" value="Voir" <?php echo 'name="voir'.$row['numclient'].'"'; ?> >        
            </center>    
        </TD>
            </CENTER>

    <?php

    }}}}

    $select_orders = $con->prepare("select *from client;");
        $select_orders->execute();
        if($select_orders->rowCount() > 0){
            while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
              $modifier="green".$row['numclient'];
              if(isset($_POST[$modifier])){
                $numclient=explode("green","green".$row['numclient']);
                
                  $stmt=$con->prepare("insert into commande(datecommande,numclient) values(CURRENT_DATE,".$row['numclient'].");");
                    if($stmt->execute()){
                      
                      
                    }else{
                      echo "insert into commande(datecommande,numclient) values(CURRENT_DATE,".$row['numclient'].");";
                        echo "Ressayez !!!!!!!!";
                    }
              } 
            }
        }

      
$select_orders = $con->prepare("select *from client;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
  $voir="voir".$row['numclient'];
  if(isset($_POST[$voir])){
      echo '<h3>Les commandes de '.$row['nomclient'].'</h3><br>';
      $stmt=$con->prepare("select nomclient, cmd.* from client c,commande cmd where c.numclient=cmd.numclient and cmd.numclient=".$row['numclient'].";");
      
      $stmt->execute();
                    if($stmt->rowCount()>0){
                      
  ?>


<table border="1" width="83%" align="right">
            <tr>
                <th bgcolor="#0a2558"><center><font color="white">Numero du client</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Nom du client</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Numero du commande</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Date du commande</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Modifier Commande</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Supprimer Commande</font></center></th>
            </tr>  

  <?php
                    while($row1= $stmt->fetch(PDO::FETCH_ASSOC)){
                      ?>
<tr>
            <td><center><?php echo $row['numclient']; ?></center></td>
            <td><center><?php echo$row1["nomclient"]; ?></center></td>
            <td><center><?php echo $row1["numcommande"] ;?></center></td>
            <td><center><?php echo $row1["datecommande"]; ?></center></td>
            <td><center><input type="submit" class="green" value="Modiifer" <?php echo 'name="modifier'.$row1['numcommande'].'"'; ?> ></center></td>
            <td><center><input type="submit" class="red" value="Supprimer" <?php echo 'name="supprimer'.$row1['numcommande'].'"'; ?> ></center></td>
            </tr>
    <?php
                    }
                    }else{
                        echo "Aucune commande existe pour ce client";
                    }
  }
}
}

if(isset($_POST['all_cmd'])){  

?>
</table>
<table border="1" width="83%" align="right">
            <tr>
                <th bgcolor="#0a2558"><center><font color="white">Numero du client</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Nom du client</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Numero du commande</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Date du commande</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Modifier Commande</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Supprimer Commande</font></center></th>
            </tr>  

            <?php
            $select_orders = $con->prepare("select nomclient, cmd.* from client c,commande cmd where c.numclient=cmd.numclient;");
            $select_orders->execute();
            if($select_orders->rowCount() > 0){
            while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>

<tr>
            <td><center><?php echo $row['numclient']; ?></center></td>
            <td><center><?php echo$row["nomclient"]; ?></center></td>
            <td><center><?php echo $row["numcommande"] ;?></center></td>
            <td><center><?php echo $row["datecommande"]; ?></center></td>
            <td><center><input type="submit" class="green" value="Modiifer" <?php echo 'name="modifier'.$row['numcommande'].'"'; ?> ></center></td>
            <td><center><input type="submit" class="red" value="Supprimer" <?php echo 'name="supprimer'.$row['numcommande'].'"'; ?> ></center></td>
            </tr>

<?php
            }}
}
$select_orders = $con->prepare("select *from commande;");
        $select_orders->execute();
        if($select_orders->rowCount() > 0){
            while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
              $modifier="modifier".$row['numcommande'];
              if(isset($_POST[$modifier])){               
                  $_SESSION['numcommande']=$row['numcommande'];
                  header("location:modifier_commande.php");
                  ob_end_flush();
              } 
            }
        }

        $select_orders = $con->prepare("select *from commande;");
        $select_orders->execute();
        if($select_orders->rowCount() > 0){
            while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
              $supprimer="supprimer".$row['numcommande'];
              if(isset($_POST[$supprimer])){  
                $stmt1=$con->prepare("INSERT into archive(numcommande,numclient,prix_unitaire,qtecommandee,refproduit,nomclient)  select c.numcommande,c.numclient,p.prixunitaire,lc.qtecommandee,p.refproduit,cl.nomclient
                    from CLIENT cl,commande c,ligne_commande lc,produit p where cl.numclient=c.numclient and c.numcommande=lc.numcommande and lc.refproduit=p.refproduit and c.numcommande=".$row['numcommande'].";");
                    
                    if($stmt1->execute()){
                      echo("done");
                  }else{
                      echo "Ressayez ??!";
                  }             
                $stmt=$con->prepare("delete from commande where numcommande=".$row['numcommande'].";");
                if($stmt->execute()){
                  header("location:commande.php");
                }
                 
              } 
            }
        }

    ?>


    </div>
    </center>

    
  </body>
</html>

<?php $con=null ?>