<?php
$servername = "localhost";
$dsn = 'pgsql:dbname=d41r33irt5d95s;host=ec2-50-17-235-5.compute-1.amazonaws.com';
$user = 'fhvelsuqwoldap';
$password = '8eab73213045662b7e6d5bc4e09616e10c8d41828a818209ab8c602a36acdec6';
$conn = new PDO($dsn, $user, $password);
 
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $post_id=isset($_GET['post_id']) ? $_GET['post_id'] : die('ERROR: Record ID not found.');
 
    // delete query
    $query = "DELETE FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $post_id);
     
    if($stmt->execute()){
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: index.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>