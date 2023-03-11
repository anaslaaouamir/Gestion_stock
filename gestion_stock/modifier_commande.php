

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
    <form action="modifier_commande.php" method="POST">
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
            <h3>Détailles de Commande</h3>
            <br><br>
            <?php 
            include 'db.php'; 

            session_start();
            ob_start();
          


                $select_orders = $con->prepare("select *from commande where numcommande=".$_SESSION['numcommande'].";");
                $select_orders->execute();
                while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
                    ?>
                <table border="1">
                    <tr>
                    <th bgcolor="#0a2558"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero du client&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></th>
                    <th bgcolor="#0a2558"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nom du client&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></th>
                    <th bgcolor="#0a2558"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero du commande&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></th>
                    <th bgcolor="#0a2558"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date du commande&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></th>
                    <th bgcolor="#0a2558"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Montant totale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></th>
                    </tr>
                    <tr>
                        <td><center><?php echo $row['numclient']; ?></center></td>
                        <td> <center><?php $select_orders = $con->prepare("select nomclient from client where numclient=".$row['numclient'].";");
                        $select_orders->execute();
                        while($row1= $select_orders->fetch(PDO::FETCH_ASSOC)){echo $row1['nomclient'];}?></center></td>
                        <td><center><?php echo $row['numcommande']; ?></center></td>
                        <td><center><?php echo $row['datecommande'] ;?></center></td>
                        <td><center><?php
                          $select_orders = $con->prepare(" select sum(qtecommandee*prixunitaire) x from ligne_commande l,produit p where p.refproduit=l.refproduit and numcommande=".$_SESSION['numcommande'].";");
                          $select_orders->execute();
                          while($row1= $select_orders->fetch(PDO::FETCH_ASSOC)){echo $row1['x'];}
                        ?></center></td>
                    </tr>
                </table>
                <?php
                }
            ?>
            <br><br>
        
        <style>
      input[type=button],
      input[type=submit].blue {
        background-color: #0a2558;
        color:white;
        padding: 8px 15px;
      }
    </style>
        
        
        <br><br><br>
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




      <?php
        
        $stmt=$con->prepare("select p.refproduit,p.nomproduit,prixunitaire,p.qtestockee,l.qtecommandee,(qtecommandee*prixunitaire) prixtotal
        from ligne_commande l,produit p WHERE numcommande=".$_SESSION['numcommande']." and p.refproduit=l.refproduit;");
        
        $stmt->execute();
                      if($stmt->rowCount()>0){
                        
    ?>
  <h3>Les lignes de commande existent</h3>
  <br>
  <table border="1" width="83%" align="right">
              <tr>
                  <th bgcolor="#0a2558"><center><font color="white">Ref produit</font></center></th>
                  <th bgcolor="#0a2558"><center><font color="white">Nom produit</font></center></th>
                  <th bgcolor="#0a2558"><center><font color="white">Prix Unitaire</font></center></th>
                  <th bgcolor="#0a2558"><center><font color="white">Quantité en stock</font></center></th>
                  <th bgcolor="#0a2558"><center><font color="white">Quantité commandée</font></center></th>
                  <th bgcolor="#0a2558"><center><font color="white">Prix Totale</font></center></th>
                  <th bgcolor="#0a2558"><center><font color="white">Supprimer</font></center></th>
                  
              </tr>  
  
    <?php
                      while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
  <tr>
              <td><center><?php echo $row['refproduit']; ?></center></td>
              <td><center><?php echo$row["nomproduit"]; ?></center></td>
              <td><center><?php echo $row["prixunitaire"] ;?></center></td>
              <td><center><?php echo $row["qtestockee"]; ?></center></td>
              <td><center><?php echo $row["qtecommandee"] ;?></center></td>
             <td><center><?php echo $row["prixtotal"]; ?></center></td>
               <td><center><input type="submit" class="red" value="supprimer" <?php echo 'name="'.$_SESSION['numcommande'].'supprimer'.$row['refproduit'].'"'; ?> ></center></td>
              
              <tr>
              
      <?php
                      }
                      }else{
                          echo "Aucune ligne existe ajouter une ci dessous<br><br>";
                      }

                      $select_orders = $con->prepare("select *from ligne_commande;");
                      $select_orders->execute();
                      if($select_orders->rowCount() > 0){
                      while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
                        $supprimer=$row['numcommande'].'supprimer'.$row['REFproduit'];
                        if(isset($_POST[$supprimer])){
                            $stmt=$con->prepare("delete from ligne_commande where numcommande=".$row['numcommande']." and refproduit=".$row['REFproduit'].";");
                                          if($stmt->execute()){
                                            
                                            echo("done");
                                            
                                          }else{
                                              echo "Ressayez !!!!!!!!";
                                          }
                        }
                      }
                      }
                  
                      /*$select_orders = $con->prepare("select *from ligne_commande where numcommande=".$_SESSION['numcommande'].";");
                      $select_orders->execute();
                      if($select_orders->rowCount() > 0){
                      while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
                        $modifier=$_SESSION['numcommande'].'modifer'.$row['REFproduit'];
                        echo $modifier;
                        if(isset($_POST[$modifier])){
                          echo $modifier;
                          echo ("select *from produit where refproduit=".$row['REFproduit'].";");
                          $select_orders1 = $con->prepare("select *from produit where refproduit=".$row['REFproduit'].";");
                          $select_orders1->execute();
                          if($select_orders1->rowCount() > 0){
                          while($row1= $select_orders1->fetch(PDO::FETCH_ASSOC)){
                            echo '   yes   ';
                            $var=$_POST['qte'];
                            echo 'new input:      '.$var.'    ';
                            if(($row1['qtestockee']-($_POST['qte']-$row['qtecommandee']))>=0){
                              
                              $stmt=$con->prepare("update ligne_commande set qtecommandee=".$var." where refproduit=".$row['REFproduit']." and numcommande=".$row['numcommande'].";");
                              echo ("update ligne_commande set qtecommandee=".$var."<br> where refproduit=".$row['REFproduit']." and numcommande=<br> ".$_SESSION['numcommande'].";"); 
                              if($stmt->execute()){
                                            echo '   finish';
                                           header("location:modifier_commande.php");
                                          }
                            }
                          }
                        }
                      }
                      }}*/

?>
</table>
<br><br>
<h3>Les produits disponible</h3> 
        <br><br>
        <table border="1" width="83%" align="right">
            <tr>
                <th bgcolor="#0a2558"><center><font color="white">Nom</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Ref</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Prix Unitaire</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Quantité en stock</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Quantité</font></center></th>
                <th bgcolor="#0a2558"><center><font color="white">Ajouter</font></center></th>
                
            </tr>
<?php
$select_orders = $con->prepare('select *from produit where indisponible = "0" and refproduit not in (
  select refproduit from ligne_commande where numcommande='.$_SESSION['numcommande'].');');
  
$select_orders->execute();
if($select_orders->rowCount() > 0){
   while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
          
?>
  <tr>
            <td><center><?php echo $row["nomproduit"]; ?></center></td>
            <td><center><?php echo $row["refproduit"]; ?></center></td>
            <td><center><?php echo$row["prixunitaire"]; ?></center></td>
            <td><center><?php echo $row["qtestockee"] ;?></center></td>
            <td><center><input type="number" <?php echo 'name="'.$row['refproduit'].'"'; ?>></center></td>
            <td><CENTER>
            <input type="submit" class="green" value="Ajouter" <?php echo 'name="green'.$row['refproduit'].'"'; ?> >
            </CENTER></td>
            <td></td>
  
<?php
}
}

$select_orders = $con->prepare("select *from produit;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
  $ajouter="green".$row['refproduit'];
  if(isset($_POST[$ajouter])){
    if($_POST[$row['refproduit']]==null || $_POST[$row['refproduit']]<=0){
      echo '<td><center>La quantité n est pas correct</center></td>';
    }else{
      if($row['qtestockee']<$_POST[$row['refproduit']]){
        echo '<td><center>Le stock ne contient pas la quantité commandée</center></td>';
      }else{
        $stmt=$con->prepare('insert into ligne_commande(numcommande,refproduit,qtecommandee) values('.$_SESSION['numcommande'].','.$row['refproduit'].','.$_POST[$row['refproduit']].');');
                    if($stmt->execute()){
                      $qte=$row['qtestockee']-$_POST[$row['refproduit']];
                      $stmt2=$con->prepare('update produit set qtestockee='.$qte.' where refproduit='.$row['refproduit'].';');
                      if($stmt2->execute()){
                        
                        $select_orders1 = $con->prepare("select *from produit where refproduit=".$row['refproduit'].";");
                        $select_orders1->execute();
                        if($select_orders1->rowCount() > 0){
                        while($row1= $select_orders1->fetch(PDO::FETCH_ASSOC)){
                          if($row1['qtestockee']==0){
                            $stmt1=$con->prepare('update produit set indisponible="1" where refproduit='.$row1['refproduit'].';');
                            if($stmt1->execute()){
                              ECHO('done');
                              
                              
                            }
                          }

    
  }header("location:modifier_commande.php");
  ob_end_flush();}

}
}
                      
      }
}
}}}
   
?>   
 </tr>           
            
        </table>
    </div>
    </center>

    
  </body>
</html>

<?php $con=null ?>