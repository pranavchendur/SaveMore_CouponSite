<?php
   require 'db/connect.php';

   $sql ="SELECT * from listing WHERE id=".$_GET['id']." LIMIT 1;";

   $ret = pg_query($db, $sql);
   if(!$ret){
      echo pg_last_error($db);
      exit;
   } 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Coupon Details</title>
	<link rel="stylesheet" type="text/css" href="css/coupon-det.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
	<center>
	<div id="site-logo">
		<a href="index.html">
			<span id="logo-text">SaveMore</span>
		</a>
	</div>
	<?php
        while($row = pg_fetch_assoc($ret)){
    ?>
	<div id="header">
		<span id="coupon-head"><?php echo $row['title']; ?> on <?php echo $row['category']; ?></span> on <span id="site-head"><?php echo $row['site']; ?></span>	
	</div>
	
	<div id="details">
		<img id="det-img" src="<?php echo $row['image']; ?>">
		<div id="sub">
			<span id="sub-head">Description</span> : <span id="sub-det"><?php echo $row['description']; ?></span><br>	
		</div>
		<div id="sub">
			<span id="sub-head">Category</span> : <span id="sub-det"><?php echo $row['category']; ?></span>	
		</div>
		<div id="sub">
			<span id="sub-head">Coupon Code</span> : <span id="sub-det"><?php echo $row['coupon_code']; ?></span>	
		</div>
		<div id="sub">
			<span id="sub-head">Expiration Date</span> : <span id="sub-det"><?php echo $row['expdate']; ?></span>	
		</div>
		<div id="buttons">
			<a id="red" href="index.html"><button><b><</b> Back</button></a>
			<a id="green" target="_blank"> href="<?php echo $row['url']; ?>"><button>Open Website</button></a>
		</div>
	<?php
         
         }

         //echo "Operation done successfully\n";
         pg_close($db);
    ?>
	</div>
	</center>
</body>
</html>