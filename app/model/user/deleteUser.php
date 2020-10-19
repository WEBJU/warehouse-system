<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

	if(isset($_POST['userDetailsUserID'])){

		$userDetailsUserID = htmlentities($_POST['userDetailsUserID']);

		// Check if mandatory fields are not empty
		if(!empty($userDetailsUserID)){

			// Sanitize vendorID
			$userDetailsUserID = filter_var($userDetailsUserID, FILTER_SANITIZE_STRING);

			// Check if the customer is in the database
			$userSql = 'SELECT userID FROM user WHERE userID=:userID';
			$userStatement = $conn->prepare($userSql);
			$userStatement->execute(['userID' => $userDetailsUserID]);

			if($userStatement->rowCount() > 0){

				// Vendor exists in DB. Hence start the DELETE process
				$deleteUserSql = 'DELETE FROM user WHERE userID=:userID';
				$deleteUserStatement = $conn->prepare($deleteUserSql);
				$deleteUserStatement->execute(['userID' => $userDetailsUserID]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>User deleted.</div>';
				exit();

			} else {
				// Vendor does not exist, therefore, tell the user that he can't delete that vendor
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>User does not exist in DB. Therefore, can\'t delete.</div>';
				exit();
			}

		} else {
			// vendorDI is empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the User ID</div>';
			exit();
		}
	}
?>
