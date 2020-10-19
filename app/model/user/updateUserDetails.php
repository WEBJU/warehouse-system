<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

	// Check if the POST query is received
	if(isset($_POST['userDetailsUserID'])) {

		$userDetailsUserID = htmlentities($_POST['userDetailsUserID']);
		$userDetailsUserFullName = htmlentities($_POST['userDetailsFullName']);
		$userDetailsUsername = htmlentities($_POST['userDetailsUserName']);
		$userDetailsUserRole = htmlentities($_POST['userDetailsUserRole']);
		$userDetailsUserStatus = htmlentities($_POST['userDetailsUserStatus']);
		// Check if vendorID is given or not. If not given, the display a message
		if(!empty($userDetailsUserID)){
			// Check if mandatory fields are not empty
			if(!empty($userDetailsUserFullName) && !empty($userDetailsUsername)) {
				// Check if vendorID field is empty. If so, display an error message
				// We have to specifically tell this to user because the (*) mark is not added to that field
				if(empty($userDetailsUserID)){
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the User ID to update that vendor. You can find the User ID using the Search tab</div>';
					exit();
				}
				// Check if the given vendorID is in the DB
				$userIDSelectSql = 'SELECT userID FROM user WHERE userID = :userID';
				$userIDSelectStatement = $conn->prepare($userIDSelectSql);
				$userIDSelectStatement->execute(['userID' => $userDetailsUserID]);

				if($userIDSelectStatement->rowCount() > 0) {

					// vendorID is available in DB. Therefore, we can go ahead and UPDATE its details

					// But first update the purchase details vendor name in the purchase table
					$userNameSql = 'UPDATE user SET fullName = :fullName,username = :username,role = :role,status= :status WHERE userID = :userID';
					$userNameStatement = $conn->prepare($userNameSql);
					$userNameStatement->execute(['fullName' => $userDetailsUserFullName, 'userID' => $userDetailsUserID,'username'=>$userDetailsUsername,'role'=>$userDetailsUserRole,'status'=>$userDetailsUserStatus]);
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>User details updated.</div>';
					exit();
				} else {
					// vendorID is not in DB. Therefore, stop the update and quit
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>User ID does not exist in DB. Therefore, update not possible.</div>';
					exit();
				}

			} else {
				// One or more mandatory fields are empty. Therefore, display the error message
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
				exit();
			}
		} else {
			// vendorID is not given by user. Hence, can't update
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the User ID to update that user. You can find the User ID using the Search tab</div>';
			exit();
		}
	}
?>
