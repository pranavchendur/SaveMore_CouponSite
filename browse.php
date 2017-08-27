<?php

   //include connection script for connecting to the database
   require 'db/connect.php';
   if (isset($_GET['query'])) {
      
      //the query string is received from the url and converted top lower case.
      $q = strtolower($_GET['query']);

      //SQL Commands to search the table for the rows which are to be displayed for the category listing page with query parameters searched through the columns category, site, title and description.

      //lower is used to coinvert all the letters to lower case in-order to get proper matching.

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
      
         //Loops throught the fetched data and returns the result in the form of formatted and styled HTML
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