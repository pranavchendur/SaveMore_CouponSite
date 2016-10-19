<?php
   require 'db/connect.php';
   if (isset($_GET['query'])) {
      $q = strtolower($_GET['query']);
      $sql ="SELECT id,title,category,site FROM listing WHERE lower(title) LIKE '%".$q."%' OR lower(category) LIKE '%".$q."%' OR lower(site) LIKE '%".$q."%' OR lower(description) LIKE '%".$q."%';";

      $smsg="for ".$_GET['query'];
   }
   else {
      $sql ="SELECT id,title,category,site FROM listing;"; 
      $smsg="";  
   }
   
   $ret = pg_query($db, $sql);
   if(!$ret){
      echo pg_last_error($db);
      exit;
   } 
?>

<!DOCTYPE html>
<html>
<head>
   <title>Search results</title>
   <link rel="stylesheet" type="text/css" href="css/coupon-det.css">
   <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<body>
   <center>
   <div id="site-logo">
      <a href="index.html">
         <span id="logo-text">SaveMore</span>
      </a>
   </div>
   </center>

   <div id="search-bar">
      <center>
         <form method="get" action="browse.php">
            <input type="text" name="query" align="right"  placeholder="Search">
         </form>
      </center>
      <br>
      <p id="search-term">Search Results <?php echo $smsg; ?></p>
      <p id="search-result">
      <?php
         while($row = pg_fetch_assoc($ret)){
            echo "<a class=\"effect-underline\" href=\"coupon.php?id=".$row['id']."\">". $row['site'] ." - ". $row['title'] ." on ".$row['category'] ."</a>";
      ?>
      <br><br>
      
      <?php
         
         }

         //echo "Operation done successfully\n";
         pg_close($db);
      ?>
      </p>
   </div>
   <center>
      <div id="buttons">
         <a id="red" href="index.html"><button><b><</b> Back</button></a>
      </div>
   </center>

</body>
</html>