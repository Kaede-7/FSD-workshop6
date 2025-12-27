<?php
    include "db.php";
    
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];

        $sql = "INSERT INTO students (name,email,course) 
            VALUES('$name','$email','$course')";
        $result = $conn ->query($sql);
        if($result){
            echo "Student added Succesfully!<br><br>";
        }
        else{
            echo "Error: " . $conn->error;
        }
        
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record Management.</title>
    <style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 10px;
     }
</style>
</head>
<body>
    <hr>
    <form method="post" action="">
        <h1>Add Students</h1>
        Name: <input type="text" name="name" required> <br> <br>
        Email: <input type="email" name="email" required> <br> <br>
        Course: <input type="text" name="course" required> <br> <br>
        <input type="submit" name="submit" value="Add"> <br>
    </form>
    <hr>
    <table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Actions</th>
    </tr>

</body>
</html>

<?php
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['course'] . "</td>";
        echo "<td>
                <a href='edit.php?id=" . $row['id'] . "'>Edit</a> |
                <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
              </td>";
        echo "</tr>";
    }
}
?>
