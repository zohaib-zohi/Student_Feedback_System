<?php
include("db_connect.php");

$error = "";
$success = "";

if(isset($_POST['submit'])){

    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

    // Validation
    if(empty($name) || empty($message)){
        $error = "All fields are required!";
    }
    elseif(strlen($name) < 3){
        $error = "Name must be at least 3 characters!";
    }
    else{
        $name = mysqli_real_escape_string($conn, $name);
        $message = mysqli_real_escape_string($conn, $message);

        $sql = "INSERT INTO feedback(name, message) VALUES('$name','$message')";

        if(mysqli_query($conn, $sql)){
            $success = "Feedback submitted successfully!";
        }
        else{
            $error = "Database Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Feedback System</title>
    <style>
        body{
            font-family: Arial;
            background: #f4f4f4;
        }
        .container{
            width: 400px;
            background: white;
            padding: 20px;
            margin: 50px auto;
            box-shadow: 0px 0px 10px gray;
            border-radius: 6px;
        }
        input, textarea{
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        button{
            background: green;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
        }
        .error{color:red;}
        .success{color:green;}
        table{
            width:100%;
            margin-top:20px;
            border-collapse: collapse;
        }
        th,td{
            border:1px solid #ccc;
            padding:6px;
        }
    </style>
</head>
<body>

<div class="container">
<h2>Student Feedback System</h2>

<?php if($error): ?>
<p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<?php if($success): ?>
<p class="success"><?php echo $success; ?></p>
<?php endif; ?>

<form method="POST">
    Name:
    <input type="text" name="name" placeholder="Enter your name">

    Message:
    <textarea name="message" placeholder="Enter feedback"></textarea>

    <button type="submit" name="submit">Send Feedback</button>
</form>

<hr>

<h3>All Feedback</h3>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Message</th>
<th>Time</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM feedback ORDER BY id DESC");

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
    <td>".$row['id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['message']."</td>
    <td>".$row['created_at']."</td>
    </tr>";
}
?>

</table>

</div>
...
</table>

<!-- Developer Credit -->
<p style="text-align:center; margin-top:20px; font-size:12px; color:gray;">
    <b>
    Designed by Muhammad Zohaib CS7th Semester
    Khushal Khan Khattak University Karak
    </b>
</p>

</div>
</body>
</html>

</body>
</html>
