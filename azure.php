<?php



try {
    // List blobs.
    $blob_list = $blobRestProxy->listBlobs("----");
    $blobs = $blob_list->getBlobs();

    foreach($blobs as $blob)
    {
        echo "<br><div class='col-md-4' style='word-wrap: break-word;'>
  <div style='cursor: default;text-decoration:none; box-shadow:0  0 15px #888888;' class='thumbnail'><h3>". $blob->getName()."<hr></h3><br />";
        echo"<div class='portfolio-item' style='border:0px;'>
							<div class='portfolio-image' ><img src=".$blob->getUrl()."></div></div></div></div>";
    }
}
catch(ServiceException $e){
    // Handle exception based on error codes and messages.
    // Error codes and messages are here: 
    // http://msdn.microsoft.com/library/azure/dd179439.aspx
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $code.": ".$error_message."<br />";
}


?>