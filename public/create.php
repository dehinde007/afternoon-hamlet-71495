<?php
$dsn = 'pgsql:dbname=d41r33irt5d95s;host=ec2-50-17-235-5.compute-1.amazonaws.com';
$user = 'fhvelsuqwoldap';
$password = '8eab73213045662b7e6d5bc4e09616e10c8d41828a818209ab8c602a36acdec6';

 If(isset($_POST['submit'])){
    try {
   $conn = new PDO($dsn, $user, $password);

  // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // prepare sql and bind parameters
   $sql = $conn->prepare("INSERT INTO posts (title, content, tag)
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

<form action="" method="post">
  <input type="title" name="title">
   <input type="content" name="content">
  <input type="tag" name="tag">
  <input type="submit" name="submit" value="submit">
</form>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
