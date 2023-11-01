<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="php.css">
    <title>Comment</title>
</head>
<body>
<div class="youtube">
<iframe width="850" height="550" src="https://www.youtube.com/embed/4M9qCyxSiJs?si=vn9e3sEPFo8iul6m" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>

<form method="POST" action="index.php">
  <label for="name">Naam:</label><br>
  <input type="text" id="name" name="name" required><br>
  <label for="email">E-mail:</label><br>
  <input type="email" id="email" name="email" required ><br>
  <label for="comment">Commentaar:</label><br>
  <textarea name="comment" rows="5" cols="40" required></textarea>
  <input type="submit" value="Submit">
</form>

</body>
</html>

<?php
include("connection.inc.php");

$sql = "SELECT name, id, email, comment FROM video order by name ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>

Geef comments weer: <br> <br>
<?php
while($row = mysqli_fetch_assoc($result)) {
    echo   "- E-mail: " . $row["email"] . "<br>"  .  " - Name: " . $row["name"].  "<br>"  . " - Comment: " . $row["comment"].  "<br>" . "<br>";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  if (empty($name)) {
    echo "Name is empty";
  } else {
    echo "<br>" . $name . ": <br>";
  }
  $emailRequest = $_POST['email'];
  if (empty($emailRequest)) {
    echo "email is empty";
  } else {
    echo "<br>" . $emailRequest;
  }
  
  $commentText = $_POST['comment'];
  if (empty($commentText)) {
    echo "comment is empty";
  } else {
    echo  "<br>" . $commentText. ": <br>";
  }


  $sql = "INSERT INTO video (name, email, comment)
  VALUES ('$name', '$emailRequest', '$commentText ')";
  
  if ($conn->query($sql)) {
      echo "<br>New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



$conn->close();
?>


