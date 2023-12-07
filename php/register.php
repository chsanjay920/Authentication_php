<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'users';

$con = mysqli_connect(
    $DATABASE_HOST,
    $DATABASE_USER,
    $DATABASE_PASS,
    $DATABASE_NAME
);

if(mysqli_connect_error())
{
    exit('Error connecting to the database: ' . mysqli_connect_error());
}

if(empty($_POST['firstName']) || 
   empty($_POST['lastName']) || 
   empty($_POST['email']) || 
   empty($_POST['password']) || 
   empty($_POST['phone']) || 
   empty($_POST['dateOfBirth']) || 
   empty($_POST['gender']) || 
   empty($_POST['bio']))
{
    exit("Empty Feilds ");
}

if($stmt = $con->prepare('SELECT id, password FROM usertable WHERE email = ?'))
{
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0)
    {
        echo 'Email already exists';
    }
    else {
        if($stmt = $con->prepare('INSERT INTO usertable (firstName, lastName, email, password, phone, dateOfBirth, gender, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'))
        {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ssssssss', $_POST['firstName'], $_POST['lastName'], $_POST['email'], $password, $_POST['phone'], $_POST['dateOfBirth'], $_POST['gender'], $_POST['bio']);
            $stmt->execute();
            echo 'Successfully Registered';
        }
        else {
            echo 'Error Occurred';
        }
    }
    $stmt->close();
}
else {
    echo 'Error Occurred';
}

$con->close();

?>
