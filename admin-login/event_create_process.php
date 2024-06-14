<?php
include 'layouts/session.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (isset($_POST["eventName"]) && isset($_POST["eventDate"]) && isset($_POST["event_location"])) 
		{

			$event_name = mysqli_real_escape_string($link, $_POST["eventName"]);
			$event_date = mysqli_real_escape_string($link, $_POST["eventDate"]);
			$event_location = mysqli_real_escape_string($link, $_POST["event_location"]);

			$sql = "INSERT INTO bnr_generated_qrcode (event_name, event_date, event_location,created_date) VALUES ('$event_name', '$event_date', '$event_location',now())";
			if (mysqli_query($link, $sql)) {
				$newEventID = mysqli_insert_id($link);
				echo $newEventID;
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($link);
			}
			mysqli_close($link);
		} else {
			echo "Error: Required fields are missing.";
		}
	} 
	else 
	{
		echo "Error: Invalid request method.";
	}
?>
