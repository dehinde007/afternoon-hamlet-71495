
<?php include "templates/header.php"; ?>
<div class="container">

<h1 class="indexh1">Simple Database App</h1><br>

<script type='text/javascript'>
function delete_post( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    } 
}
</script>

<?php
$dsn = 'pgsql:dbname=d41r33irt5d95s;host=ec2-50-17-235-5.compute-1.amazonaws.com';
$user = 'fhvelsuqwoldap';
$password = '8eab73213045662b7e6d5bc4e09616e10c8d41828a818209ab8c602a36acdec6';
$conn = new PDO($dsn, $user, $password);

  // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $stmt = $conn->prepare("SELECT id, title, content, tag FROM posts"); 
   $stmt->execute();

   $num = $stmt->rowCount();
// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Post</a>";
 
//check if more than 0 record found
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";//start table
     
        //creating our table heading
        echo "<br><tr>";
            echo "<th>ID</th>";
            echo "<th>Title</th>";
            echo "<th>Description</th>";
            echo "<th>Tag</th>";
            echo "<th>Action</th>";
        echo "</tr>";
         
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['firstname'] to
            // just $firstname only
            extract($row);
             
            // creating new table row per record
            echo "<br><tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$title}</td>";
                echo "<td>{$content}</td>";
                echo "<td>{$tag}</td>";
                echo "<td>";
                    // read one record 
                    echo "<a href='read.php?id={$id}' class='btn btn-info m-r-1em'>View </a>";
                     
                    // we will use this links on next part of this post
                    echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
 
                    // we will use this links on next part of this post
                    echo "<a href='#' onclick='delete_post({$id});'  class='btn btn-danger'>Delete</a>";
                echo "</td>";
            echo "</tr>";
        }
     
    // end table
    echo "</table>";
     
}
 
// if no records found
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>

</div>

<div class="container">
<br><br>    
<?php include "templates/footer.php"; ?>
</div>
