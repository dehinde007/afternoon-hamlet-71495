<?php include "templates/header.php"; ?>
<div class="container">

<h1 class="indexh1">Simple Database App</h1><br>

<?php
$servername = "localhost";
$username = "root";
$password = "ambition1";
//Creating connection for mysql
$conn = new PDO("mysql:host=$servername;dbname=sblog", $username, $password);

 If(isset($_POST['submit'])){
    try {
  // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // prepare sql and bind parameters
   $sql = $conn->prepare("INSERT INTO blogdata (title, content, tag)
    VALUES (:title, :content, :tag)");
    $sql->bindParam(':title', $title);
    $sql->bindParam(':content', $content);
    $sql->bindParam(':tag', $tag);

    $title = $_POST['title'];
    $content = $_POST['content'];
    $tag = $_POST['tag'];
    $sql->execute();
    echo "<script type= 'text/javascript'>alert('New records created successfully');</script>"; 

}catch(PDOException $e){
  echo "Error: " . $e->getMessage();
}
$conn = null;
}
?>

<?php include "templates/header.php"; ?>

<h2>Add a post</h2>

<form action="" method="post" class="createform">
  <p><input type="title" name="title" placeholder="Title" class="form-control"></p>
  <p><input type="content" name="content" placeholder="Description" class="form-control"></p>
  <p><input type="tag" name="tag" placeholder="Tag" class="form-control"></p>
  <input type="submit" name="submit" value="submit" class="btn btn-default">
</form>

<br><a href='index.php' class='btn btn-info'>Back to posts</a>

</div>

<div class="container">
<br><br>    
<?php include "templates/footer.php"; ?>
</div>
