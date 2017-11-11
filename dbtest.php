<?php

/* Connect to a MySQL database using driver invocation */
$dsn = 'psql:dbname=d41r33irt5d95s;host=ec2-50-17-235-5.compute-1.amazonaws.com';
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


<html>
<br> <br>
 <head>
  <title>Posts</title>
 </head>
 <body>
  <table>
   <thead>
    <tr>
     <th>Post ID</th>
     <th>Title</th>
     <th>Content</th>
     <th>Tag</th>
    </tr>
   </thead>
   <tbody>
<?php
$query = "SELECT post_id, title, content, tag "
     . "FROM posts ORDER BY title ASC, content ASC";
$result = $dbh->query($query);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row["post_id"] . "</td>";
    echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["content"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["tag"]) . "</td>";
    echo "</tr>";
}
$result->closeCursor();
?>
   </tbody>
  </table>
 </body>
</html>