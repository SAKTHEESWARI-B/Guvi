<?php

require 'config.php';
session_start();
//require 'session.php';

//--------------------------------------------------------------------------------------
//user registration
//--------------------------------------------------------------------------------------
if(isset($_POST['save_user']))
{
	$name = mysqli_real_escape_string($db, $_POST['name']);
    $mail = mysqli_real_escape_string($db, $_POST['mail']);
	$pass = mysqli_real_escape_string($db, $_POST['pass']);
    $cpass = mysqli_real_escape_string($db, $_POST['cpass']);

    if($pass != $cpass)
    {
        $res = [
            'status' => 422,
            'message' => 'Password Mismatch'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO user(name,email,password) VALUES('$name','$mail','$pass')";
    $query_run = mysqli_query($db, $query);





    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
	
}

//login

if(isset($_POST['save_login']))
{

    $mail = mysqli_real_escape_string($db, $_POST['email']);
	$pass = mysqli_real_escape_string($db, $_POST['pass']);

    
	
	$query = "SELECT * FROM user WHERE email = '$mail' and password = '$pass'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
			$_SESSION['loggedin'] = TRUE;
         $_SESSION['login_user'] = $mail;
		 
        $res = [
            'status' => 200,
            'message' => 'Login Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Username/Password wrong'
        ];
        echo json_encode($res);
        return;
    }
	
}

if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($db, $_GET['student_id']);

    $query = "SELECT * FROM user WHERE email='$student_id'";
    $query_run = mysqli_query($db, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_student']))
{
	$errors= array();
    $student_id = mysqli_real_escape_string($db, $_POST['student_id']);

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $mail = mysqli_real_escape_string($db, $_POST['mail']);
	$dob = mysqli_real_escape_string($db, $_POST['dob']);
    $mob = mysqli_real_escape_string($db, $_POST['mob']);
    $add = mysqli_real_escape_string($db, $_POST['add']);
    $deg = mysqli_real_escape_string($db, $_POST['deg']);
    $clg = mysqli_real_escape_string($db, $_POST['clg']);
    
    if($mail == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	

    $query = "UPDATE user SET name='$name', email='$mail',Degree='$deg', college='$clg', dob='$dob',mobile='$mob',address='$add' WHERE email='$student_id'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}
?>
