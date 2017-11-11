<?php

$dsn = "pgsql:"
    . "ec2-50-17-235-5.compute-1.amazonaws.com;"
    . "dbname=d41r33irt5d95s;"
    . "user=fhvelsuqwoldap;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=8eab73213045662b7e6d5bc4e09616e10c8d41828a818209ab8c602a36acdec6";

$db = new PDO($dsn);

?>


<html>
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
$result = $db->query($query);
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