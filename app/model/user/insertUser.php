<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

	if(isset($_POST['userStatus'])){

		$fullName = htmlentities($_POST['name']);
		$username = htmlentities($_POST['username']);
		$role = htmlentities($_POST['userRole']);
		$status = htmlentities($_POST['userStatus']);
		$password=htmlentities($_POST['password']);
		// var_dump($role).exit();
		$hashPassword=md5($password);
		if(isset($fullName) && isset($username)) {

			// Start the insert process
			$sql = 'INSERT INTO user(fullName, username, password,role,status) VALUES(:fullName, :username, :password,:role,:status)';
			$stmt = $conn->prepare($sql);
	  	$stmt->execute(['fullName' => $fullName, 'username' => $username, 'password' => $hashPassword,'status'=>$status,'role' => $role,]);

				// code...
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>New User added to database Successfully</div>';

		} else {
			// One or more fields are empty
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}

	}
?>
