<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
  <form action="home.php" method="POST">
  <style>
      input[type=button],
      input[type=submit].blue {
        background-color: #0a2558;
        color:white;
        height:4px;
        padding:5px
      }
    </style>
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
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Dashboard</span>
        </div>
        
        
      </nav>
      <?php 
        include 'db.php'; 
        session_start();
        ob_start();
      ?>
      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Commande</div>
              <div class="number"><?php  $select_orders = $con->prepare("select count(*) nbr from commande;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
   while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){ echo $row['nbr'];}}  ?></div>             
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Client</div>
              <div class="number"><?php  $select_orders = $con->prepare("select count(*) nbr from client;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
   while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){ echo $row['nbr'];}}  ?></div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Produit</div>
              <div class="number"><?php  $select_orders = $con->prepare("select count(*) nbr from produit;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
   while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){ echo $row['nbr'];}}  ?></div>
              
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Revenu</div>
              <div class="number"><?php  $select_orders = $con->prepare("select sum(qtecommandee*prixunitaire) nbr from produit p,ligne_commande l where p.refproduit=l.refproduit;");
$select_orders->execute();
if($select_orders->rowCount() > 0){
   while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){ echo $row['nbr'].' DH';}}  ?></div>              
            </div>
            <i class="bx  bx-cart cart four"></i>
          </div>
        </div>
        <?php 
        $commandes_ids=array();
        $commandes_date=array();
        $commandes_id_client=array();
        $select_orders = $con->prepare("SELECT *from commande   order by datecommande desc LIMIT 8;");
          $select_orders->execute();
          if($select_orders->rowCount() > 0){
             while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
                array_push($commandes_ids,$row['numcommande']);
                array_push($commandes_date,$row['datecommande']);
                array_push($commandes_id_client,$row['numclient']);
             }}
        ?>
        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Commande recentes</div>
            <div class="sales-details">
              <ul class="details">
                <li class="topic">Date</li>
                <?php
                  foreach($commandes_date as $date){
                    echo '<li>'.$date.'</li>';
                  }
                ?>
              </ul>
              <ul class="details">
                <li class="topic">Client</li>
                <?php
                  foreach($commandes_id_client as $id){
                    $select_orders = $con->prepare("SELECT nomclient from client where numclient=".$id.";");
          $select_orders->execute();
          if($select_orders->rowCount() > 0){
             while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
              echo '<li>'.$row['nomclient'].'</li>';
             }}
                  }
                ?>
                
              </ul>
              
              <ul class="details">
                <li class="topic">Montant totale</li>
                <?php
                  foreach($commandes_ids as $id){
                    $select_orders = $con->prepare("select sum(qtecommandee*prixunitaire) x from ligne_commande l,produit p where p.refproduit=l.refproduit and numcommande=".$id.";");
          $select_orders->execute();
          if($select_orders->rowCount() > 0){
             while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
              echo '<center><li>'.$row['x'].' DH</li></center>';
             }}
                  }
                ?>
              </ul>
              <ul class="details">
                <li class="topic">.</li>
                <?php
                  foreach($commandes_ids as $id){                    
                    echo '<center><li> <input type="submit" name="det'.$id.'" value="Détails" > </li></center>';
                  }
                ?>
              </ul>
            </div>
            <div class="button">
              <a href="commande.php">Voir plus</a>
            </div>
            <?php
            $select_orders = $con->prepare("SELECT *from commande;");
            $select_orders->execute();
            if($select_orders->rowCount() > 0){
               while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){
                $details="det".$row['numcommande'];
                  if(isset($_POST[$details])){
                    $_SESSION['numcommande']=$row['numcommande'];
                    header("location:modifier_commande.php");
                    ob_end_flush();
                  }
               }}
            
            ?>
          </div>
          <div class="top-sales box">
            <div class="title">Produits les plus vendus</div>
            <ul class="top-sales-details">
              <?php $select_orders = $con->prepare("select p.nomproduit,(select sum(qtecommandee) from ligne_commande where refproduit=p.refproduit ) nbr from produit p ORDER by nbr DESC LIMIT 10;");
            $select_orders->execute();
            if($select_orders->rowCount() > 0){
               while($row= $select_orders->fetch(PDO::FETCH_ASSOC)){ ?>
              <li>              
                  <!--<img src="images/sunglasses.jpg" alt="">-->
                  <span class="product"><?php echo $row['nomproduit']; ?></span>
                <span class="price"><?php echo $row['nbr'].' Fois'; ?></span>
              </li>
              <li>
                <?php }} ?>
            </ul>
            <div class="button">
              <a href="produit.php">Voir plus</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
  </body>
</html>
<?php $con=null ?>