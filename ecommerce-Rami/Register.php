
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registeration Form</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="container">
        <?php
        if(isset($_POST["submit"])){
            $name=$_POST["name"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            $confirmPassword=$_POST["confirm_password"];
$passwordHash= password_hash($password, PASSWORD_DEFAULT);
            $errors=array();
            if(empty($name) OR empty($password) OR empty($email) OR empty($confirmPassword)){
                array_push($errors,"Please fill are the fields");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
array_push($errors,"invalid email.");
            }
            if($confirmPassword != $password){
                array_push($errors, "passwords do not match");
            }
            require "conn.php";
            $sql="SELECT * FROM users WHERE email ='$email'";
 $exist = mysqli_query($conn ,$sql);
$Rowcount =mysqli_num_rows($exist);
if($Rowcount>0){
    array_push($errors,"Email is Unavailable");
}
            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }

            }else{
                  require "conn.php";//connection
                  $sql ="INSERT INTO users(name, email, password, user_type) VALUES (?,?,?,'user')";
$stmt = mysqli_stmt_init($conn);
$prepStmt= mysqli_stmt_prepare($stmt,$sql);
if($prepStmt){
    mysqli_stmt_bind_param($stmt,"sss",$name,$email,$passwordHash);
    mysqli_stmt_execute($stmt);
    echo "<div class=''>Registered successfuly.</div>";

}else die("registeration error ");
            }
        }
        ?>
    <form action="Register.php" method="POST">
<div class="form-elements" >
    <input type="text" class="control" name="name" placeholder="Enter name: ">
</div>
<div class="form-elements"> 
<input type="email" class="control" name="email" placeholder="Enter email: ">
</div>
<div class="form-elements">
<input type="password" class="control" name="password" placeholder="Enter password: ">
</div>
<div class="form-elements">
<input type="password" class="control" name="confirm_password" placeholder="confirm password: ">
</div>
<div class="form-button">
<input type="submit" class="btn" value="register" name="submit">

</div>
<a href="login.php">Already have an account!!</a>
    </form>
</div>
</body>
</html>