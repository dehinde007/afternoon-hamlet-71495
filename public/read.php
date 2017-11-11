
<?php

/* Connect to a MySQL database using driver invocation */
$dsn = 'pgsql:dbname=d41r33irt5d95s;host=ec2-50-17-235-5.compute-1.amazonaws.com';
$user = 'fhvelsuqwoldap';
$password = '8eab73213045662b7e6d5bc4e09616e10c8d41828a818209ab8c602a36acdec6';

try {
    $dbh = new PDO($dsn, $user, $password);
if($dbh){
echo "Connected to the <strong>$db</strong> database successfully!";
        }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>


<h1>Hello there</h1>