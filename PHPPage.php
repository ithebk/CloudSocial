<?php
    include_once 'header.php';
require_once 'WindowsAzure\WindowsAzure.php';
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use	WindowsAzure\Common\CloudConfigurationManager;
use WindowsAzure\Blob\Models\Block;
use WindowsAzure\Blob\Models\CreateContainerOptions;
use WindowsAzure\Blob\Models\ListContainersOptions;
define("CONTAINERNAME", "----");
if(isset($_POST['InputName'])){
define("BLOCKBLOBNAME", $_POST['InputName']);
define("FILENAME",$_FILES['InputFile']['name'] );
}
define("BLOCKSIZE", 4 * 1024 * 1024);    // Size of the block, modify if needed.
define("PADLENGTH", 5);                  // Size of the string used for the block ID, modify if needed.
       // Local file to upload as a block blob.

$connectionString = "DefaultEndpointsProtocol=https;AccountName=****;AccountKey=****";
 
function createContainerIfNotExists($blobRestProxy)
{
    // See if the container already exists.
    $listContainersOptions = new ListContainersOptions;
    $listContainersOptions->setPrefix(CONTAINERNAME);
    $listContainersResult = $blobRestProxy->listContainers($listContainersOptions);
    $containerExists = false;
    foreach ($listContainersResult->getContainers() as $container)
    {
        if ($container->getName() == CONTAINERNAME)
        {
            // The container exists.
            $containerExists = true;
            // No need to keep checking.
            break;
        }
    }
    if (!$containerExists)
    {
        echo "Creating container.\n";
        $blobRestProxy->createContainer(CONTAINERNAME);
        echo "Container '" . CONTAINERNAME . "' successfully created.\n";
    }
}
try {
   // echo "Beginning processing.\n";
  
 
    if (null == $connectionString || "" == $connectionString)
    {
        echo "Did not find a connection string whose name is 'StorageConnectionString'.";
        exit();
    }
   
    $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
    createContainerIfNotExists($blobRestProxy);
    //echo "Using the '" . CONTAINERNAME . "' container and the '" . BLOCKBLOBNAME . "' blob.\n";
    //echo "Using file '" . FILENAME . "'\n";
    
   if(isset($_FILES['InputFile']['tmp_name']))
    {
        $ret=move_uploaded_file($_FILES['InputFile']['tmp_name'],"C:/Users/BK/Documents/My Web Sites/EmptySite3/".$_FILES['InputFile']['name']);
        if($ret)
        $handle = fopen($_FILES['InputFile']['name'], "r");
    // Upload the blob using blocks.
    $counter = 1;
    $blockIds = array();
    while (!feof($handle))
    {
        $blockId = str_pad($counter, PADLENGTH, "0", STR_PAD_LEFT);
        echo "Processing block $blockId.\n";
        
        $block = new Block();
        $block->setBlockId(base64_encode($blockId));
        $block->setType("Uncommitted");
        array_push($blockIds, $block);
        
        $data = fread($handle, BLOCKSIZE);
        
        // Upload the block.
        $blobRestProxy->createBlobBlock(CONTAINERNAME, BLOCKBLOBNAME, base64_encode($blockId), $data);
        $counter++;
    }
    // Done creating the blocks. Close the file and commit the blocks.
    fclose($handle);
    echo "Commiting the blocks.\n";    
    $blobRestProxy->commitBlobBlocks(CONTAINERNAME, BLOCKBLOBNAME, $blockIds);
    
    //echo "Done processing.\n";
    redirect('photos.php', 0);
    }
}
catch(ServiceException $serviceException)
{
    // Handle exception based on error codes and messages.
    // Error codes and messages are here: 
    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
    echo "ServiceException encountered.\n";
    $code = $serviceException->getCode();
    $error_message = $serviceException->getMessage();
    echo "$code: $error_message";
}
catch (Exception $exception) 
{
    echo "Exception encountered.\n";
    $code = $exception->getCode();
    $error_message = $exception->getMessage();
    echo "$code: $error_message";
}



?>

