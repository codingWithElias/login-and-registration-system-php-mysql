<?php 

function validate_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if (isset($_POST['first_name'])&& 
	isset($_POST['last_name']) &&
    isset($_POST['email'])     &&
    isset($_POST['password'])  &&
    isset($_POST['confirm_password'])) {

	include "../db_conn.php";

	$first_name = validate_input($_POST['first_name']);
	$last_name = validate_input($_POST['last_name']);
	$email = validate_input($_POST['email']);
	$password = validate_input($_POST['password']);
	$confirm_password = validate_input($_POST['confirm_password']);

	if (empty($first_name)) {
		$errorM = "First name is required";
		header("Location: ../signup.php?error=$errorM");
	}else if (empty($last_name)) {
		$errorM = "Last name is required";
		header("Location: ../signup.php?error=$errorM");
	}else if (empty($email)) {
		$errorM = "Email is required";
		header("Location: ../signup.php?error=$errorM");
	}else if (empty($password)) {
		$errorM = "Password is required";
		header("Location: ../signup.php?error=$errorM");
	}else if (empty($confirm_password)) {
		$errorM = "Confirm password is required";
		header("Location: ../signup.php?error=$errorM");
	}else if ($password != $confirm_password) {
		$errorM = "Password and Confirm password does not match";
		header("Location: ../signup.php?error=$errorM");
	}else {
		// check if email is already in database
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
        	$errorM = "This email is already associated with another account";
		    header("Location: ../signup.php?error=$errorM");
        }else {
        	// hashing the password
        	$password = password_hash($password, PASSWORD_DEFAULT);

        	$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?,?,?,?)";
	        $stmt = $conn->prepare($sql);
	        $stmt->execute([$first_name, $last_name, $email, $password]);

	        $successM = "successfully registered!";
		    header("Location: ../signup.php?success=$successM");
	    }
	}
}else {
	header("Location: ../signup.php");
}