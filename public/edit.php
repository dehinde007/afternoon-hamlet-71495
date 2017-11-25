
<?php include "templates/header.php"; ?>
<div class="container">

<h1 class="indexh1">Simple Database App</h1><br>

<h2 class="">Read</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "ambition1";

//Creating connection for mysql
$conn = new PDO("mysql:host=$servername;dbname=sblog", $username, $password);
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT id, title, content, tag FROM blogdata WHERE id = ? LIMIT 0,1";
    $stmt = $conn->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $id);
 
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





<form action="update.php?id={$id}" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <input type="hidden" id="<?php echo $row['id'] ?> ">
        <tr>
            <td class="bold">Title</td>
            <td><input type='text' name='title' id="<?php echo $row['id'] ?>" value="<?php echo $row['title'] ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td class="bold">Description</td>
            <td><textarea type='text' name='content' id="<?php echo $row['id'] ?>" value="<?php echo $row['content'] ?>" class='form-control'> </textarea></td>
        </tr>
        <tr>
            <td class="bold">Tag</td>
            <td><input type='text' name='tag' id="<?php echo $row['id'] ?>" value="<?php echo $row['tag'] ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='index.php' class='btn btn-info'>Back to posts</a>
            </td>
        </tr>
    </table>
</form>





</div>

<div class="container">
<br><br>    
<?php include "templates/footer.php"; ?>
</div>
