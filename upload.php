<?php
// Saving data from form in text file in JSON format
		$db="tripbook";
		$collection="tripdiary";
		$sessionuser="sessionuser";
		$title="title";
		$exp="exp";//User Experience
		$filepath="filepath";
		$datetrip="datetrip";
		$imagepath="tripdiary/TripDiary/";
		$m = new MongoClient();
		echo "Connection to database successfully";
   // select a database
		$db = $m->$db;
		echo "Database mydb selected";
		$collection = $db->$collection;
		echo "Collection selected succsessfully";
  
		$target = "TripDiary/"; 
		if (!file_exists($target)) {
			mkdir($target, 0777, true);
		}
		
		$target =$target.basename($_FILES['InputFile']['name']) ; 
		$ft = pathinfo($target,PATHINFO_EXTENSION);
		echo $ft."\n";
		$ok=1; 
		if (file_exists($target)) {
			echo "Sorry, file already exists.";
			$ok = 0;}
		
		if ($_FILES["InputFile"]["size"] > 6000000) {
			echo "<script>alert('Your file is too large.'</script>"; }
 
		if($ok==0)
			{
		echo "<script>alert('Sorry, your file was not InputFile.'</script>";
		}

		else {
		if(move_uploaded_file($_FILES['InputFile']['tmp_name'], $target)) 
		{  


			echo "The file ".basename($_FILES['InputFile']['name'])." has been InputFile"; }
 
		else { echo "<script>alert('Sorry, there was a problem uploading your file.'</script>"; }
		}



		
		



			// checking if all form data are submited, else output error message


		// path and name of the file
		if(isset($_POST['InputName']) && isset($_POST['InputMessage'])&& isset($_POST['sessionuser'])) {
		// if form fields are empty, outputs message, else, gets their data
			if(empty($_POST['InputName']) || empty($_POST['InputMessage']) || empty($_POST['sessionuser']) ) {
				echo 'All fields are required';
			}
   
			else {
	
			date_default_timezone_set('Asia/Calcutta');
	///Mongo Insert:
			$document = array( 
			$sessionuser => $_POST['sessionuser'],
			$title => $_POST['InputName'], 
			$exp =>$_POST['InputMessage'], 
			$filepath =>$imagepath.$_FILES['InputFile']['name'],
			$datetrip =>(date("d-m-Y"))." ".date("h:i:sa")
			);
 
		try {
			$collection->insert($document);
			echo "Document inserted successfully";
			redirect("http://localhost/SEtest/TripDiary.php",0.0);
		} catch(MongoCursorException $e) {
    /* handle the exception */
			echo "<script>alert('Please Try Again')</script>";
		}
   
   
   //Insert FINISHED
   
	
  
		}
}
			else  'Form fields not submited';
			
		function redirect($url, $statusCode = 303)
			{
			header('Location: ' . $url, true, $statusCode);
			die();
		}
	

?>