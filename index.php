<?php 
session_start();
if (isset($_SESSION['email']) && 
          isset($_SESSION['user_id'])) { ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
</head>
<body>
     <h2>Welcome! <?php echo $_SESSION['first_name']; ?></h2>
     <h3>Email: <i><?php echo $_SESSION['email']; ?></i></h3>
     <a href="logout.php">Logout</a>
</body>
</html>
<?php }else {
	$errorM = "Login First!";
	header("Location: login.php?error=$errorM");
} ?>