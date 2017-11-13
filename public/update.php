<?php include "templates/header.php"; ?>
<div class="container">

<h1 class="indexh1">Simple Database App</h1><br>

<h2 class="">Update</h1>

<?php
$dsn = 'pgsql:dbname=d41r33irt5d95s;host=ec2-50-17-235-5.compute-1.amazonaws.com';
$user = 'fhvelsuqwoldap';
$password = '8eab73213045662b7e6d5bc4e09616e10c8d41828a818209ab8c602a36acdec6';
$conn = new PDO($dsn, $user, $password);
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
// check if form was submitted
if($_POST){
     
    try{

        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $sql = $conn->prepare("UPDATE blogdata SET title=:title, content=:content, tag=:tag WHERE id = :id");
        // posted values
        $title=htmlspecialchars(strip_tags($_POST['title']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $tag=htmlspecialchars(strip_tags($_POST['tag']));
 
        // bind the parameters
        $sql->bindParam(':title', $title);
        $sql->bindParam(':content', $content);
        $sql->bindParam(':tag', $tag);
        $sql->bindParam(':id', $id);
         
        // Execute the query
        if($sql->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td class="bold">Title</td>
            <td><input type='text' name='title' value="<?php echo htmlspecialchars($title, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td class="bold">Description</td>
            <td><textarea name='content' class='form-control'><?php echo htmlspecialchars($content, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td class="bold">Tag</td>
            <td><input type='text' name='tag' value="<?php echo htmlspecialchars($tag, ENT_QUOTES);  ?>" class='form-control' /></td>
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
