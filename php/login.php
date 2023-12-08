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

if(!isset($_POST['email'], $_POST['password']))
{
    exit("Empty Fields");
}

$email = $_POST['email'];
$password = $_POST['password'];

if(empty($email) || empty($password))
{
    exit("Empty values");
}

if($stmt = $con->prepare('SELECT id, firstName, lastName, email,phone, dateOfBirth, gender, bio, password FROM usertable WHERE email = ?'))
{
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0)
    {
        $stmt->bind_result($id, $firstName, $lastName, $email,$phone, $dateOfBirth, $gender, $bio, $hashed_password);
        $stmt->fetch();

        if(password_verify($password, $hashed_password))
        {
            $userDetails = array(
                'id' => $id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'phone'=>$phone,
                'dateOfBirth' => $dateOfBirth,
                'gender' => $gender,
                'bio' => $bio
            );

            header('Content-Type: application/json');
            echo json_encode($userDetails);
        }
        else
        {
            echo 'Incorrect password';
        }
    }
    else
    {
        echo 'User not found';
    }

    $stmt->close();
}
else
{
    echo 'Error Occurred';
}

$con->close();

?>
