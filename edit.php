<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();

}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $stmt = $conn -> prepare(
            " UPDATE students
            SET name=?, email=?, course=? 
            WHERE id=?"
    );
    $stmt->bind_param("sssi",$name,$email,$course,$id);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h1>Edit Student</h1>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

    Name:
    <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
    <br><br>

    Email:
    <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
    <br><br>

    Course:
    <input type="text" name="course" value="<?php echo $student['course']; ?>" required>
    <br><br>

    <input type="submit" name="update" value="Update Student">
</form>

</body>
</html>
