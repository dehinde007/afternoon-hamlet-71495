
<?php include "templates/header.php"; ?>
<div class="container">

<h1 class="indexh1">Simple Database App</h1><br>

<h2 class="">Read</h1>

<?php
$dsn = 'pgsql:dbname=d41r33irt5d95s;host=ec2-50-17-235-5.compute-1.amazonaws.com';
$user = 'fhvelsuqwoldap';
$password = '8eab73213045662b7e6d5bc4e09616e10c8d41828a818209ab8c602a36acdec6';
$conn = new PDO($dsn, $user, $password);

// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$post_id=isset($_GET['post_id']) ? $_GET['post_id'] : die('ERROR: Record ID not found.');
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT post_id, title, content, tag FROM post WHERE post_id = ? LIMIT 0,1";
    $stmt = $conn->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $post_id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $title = $row['title'];
    $content = $row['content'];
    $tag = $row['tag'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>

 <table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td class="bold">Title</td>
        <td><?php echo htmlspecialchars($title, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td class="bold">Description</td>
        <td><?php echo htmlspecialchars($content, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td class="bold">Tag</td>
        <td><?php echo htmlspecialchars($tag, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='index.php' class='btn btn-info'>Back to posts</a>
        </td>
    </tr>
</table>

</div>

<div class="container">
<br><br>    
<?php include "templates/footer.php"; ?>
</div>
