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
$post_id=isset($_GET["post_id"]) ? $_GET["post_id"] : die('ERROR: Record ID not found.');
 
// check if form was submitted
if($_POST){
     
    try{

        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $sql = $conn->prepare("UPDATE posts SET title=:title, content=:content, tag=:tag WHERE post_id = :post_id");
        // posted values
        $title=htmlspecialchars(strip_tags($_POST['title']));
        $content=htmlspecialchars(strip_tags($_POST['content']));
        $tag=htmlspecialchars(strip_tags($_POST['tag']));
 
        // bind the parameters
        $sql->bindParam(':title', $title);
        $sql->bindParam(':content', $content);
        $sql->bindParam(':tag', $tag);
        $sql->bindParam(':post_id', $post_id);
         
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
    // prepare select query
    $sql = $conn->prepare("SELECT post_id, title, content, tag FROM posts WHERE post_id = ? LIMIT 0,1");
 
    // this is the first question mark
    $sql->bindParam(1, $post_id);
 
    // execute our query
    $sql->execute();
 
    // store retrieved row to a variable
    $row = $sql->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $title = $row['title'];
    $content = $row['content'];
    $tag = $row['tag'];

?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?post_id={$post_id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <input type="hidden" id="<?php echo $row['post_id'] ?> ">
        <tr>
            <td class="bold">Title</td>
            <td><input type='text' name='title' value="<?php echo $row['title'] ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td class="bold">Description</td>
            <td><textarea name='content' class='form-control'><?php echo $row['content'] ?></textarea></td>
        </tr>
        <tr>
            <td class="bold">Tag</td>
            <td><input type='text' name='tag' value="<?php echo $row['tag'] ?>" class='form-control' /></td>
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
