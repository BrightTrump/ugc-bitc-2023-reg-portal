<?php

$conn = new mysqli("localhost", "root", "", "bright");
if(!$conn){
    die("Could not connect to db". mysqli_connect_error());
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['tel']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $state_council = mysqli_real_escape_string($conn, $_POST['state_council']);
    $battalion_council = mysqli_real_escape_string($conn, $_POST['battalion_council']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $rank = mysqli_real_escape_string($conn, $_POST['rank']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $course_type = mysqli_real_escape_string($conn, $_POST['course_type']);

    $img_name = $_FILES['myfile']['name'];
    $tmp_name = $_FILES['myfile']['tmp_name'];
    $img_size = $_FILES['myfile']['size'];

    //Get the image extension
	$img_explode = explode('.', $img_name);//exploding the image name so we can get the image extension
	$img_ent = end($img_explode);//getting the image extension

    $valid_extensions = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
	if (in_array($img_ent, $valid_extensions) == true) {// the image extensions is the same with the valid extension run this code
        if($img_size < 2000000){
            //removing white spaces from the image name
            $imgname = str_replace(' ', '', $img_name);
            $new_img = time().$imgname;
            if(move_uploaded_file($tmp_name, "images/".$new_img)){
                $insert = $conn->query("INSERT INTO users(fullname, tel, email, state_council, battalion_council, company, `rank`, birthday, marital_status, gender, course_type, proof_image) VALUES ('{$fullname}','{$phone}','{$email}','{$state_council}','{$battalion_council}','{$company}','{$rank}','{$birthday}','{$marital_status}','{$gender}','{$course_type}','{$new_img}')");
                if($insert){
                    echo "<script>alert('You have been registered');window.history.back();</script>";
                }else{
                    die("Not registered".mysqli_error($conn));
                }
            }
        }else{
            echo "<script>alert('The Image is too big');window.history.back();</script>";
        }
    }else{
        echo "<script>alert('Invalid Image. Please choose a correct image');window.history.back();</script>";
    }
}