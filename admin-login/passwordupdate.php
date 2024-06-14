<?php
	include 'layouts/session.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (isset($_POST["old_password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"])) 
		{
			$query = "UPDATE `bnr_admin_user` SET 
					`password`='".$_POST['new_password']."',
					`updated_date`=now()
					 WHERE admin_id = '".$_SESSION['admin_id']."'";
					
			$res = mysqli_query($link,$query);
			echo "1";
		}
		else 
		{
			echo "2";
		}
	} 
	else 
	{
		echo "3";
	}
?>