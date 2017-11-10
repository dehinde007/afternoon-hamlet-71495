<?php
 
require_once 'dbconfig.php';
 
$dsn= "mysql:host=$host;dbname=$db";
 
try{
// create a PDO connection with the configuration data
$conn = new PDO($dsn, $username, $password);
 
// display a message if connected to database successfully
if($conn){
echo "Connected to the <strong>$db</strong> database successfully!";
        }
}catch (PDOException $e){
// report error message
echo $e->getMessage();
}

?>

////////////////////////////////////////////////////////////////////////////////////// OR

<?php
$servername = "localhost";
$username = "root";
$password = "ambition1";

try {
//Creating connection for mysql
$conn = new PDO("mysql:host=$servername;dbname=sblog", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "<script type= 'text/javascript'>alert('Connected successfully');</script>";
}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

?>