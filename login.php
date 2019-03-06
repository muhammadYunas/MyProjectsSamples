<?php
require_once('config/config.php');
require_once('config/db.php');
include("includes/header.php");
// session_start();
?>
<head>
    <style>
    #registerationform { display:none;}
    </style>
</head>

<section >
<div class="container">
<div class="row">
<div class="col-md-6 mg-top-100 mg-bottom-100 col-md-offset-3">

<div>
<?php

    if (isset($_GET['newpwd'])) {
        if ($_GET['newpwd'] == 'passwordUpdated') {
            echo "<p class='text-success'>Your password has been reset!</p>";
        }
    }

    if(isset($_POST["loginsubmit"])){

        $email      = mysqli_real_escape_string($c, $_POST["email"]);
        $password   = mysqli_real_escape_string($c, $_POST["password"]);

        if (empty($email) || empty($password)) {
            header('Location: index.php?login=empty-fields');
            exit();
        } else {
            $sql         = "SELECT * FROM user WHERE email = '$email'";
            $result      = mysqli_query($c, $sql);
            $checkResult = mysqli_num_rows($result);
            if ($checkResult < 1) {
                header('Location: index.php?login=not-exist');
                exit();
            } else {
                if ($row = mysqli_fetch_assoc($result)) {
                    $hashedPwdCheck = password_verify($password, $row['userpassword']);
                    if ($hashedPwdCheck == false) {
                        header('Location: index.php?login=either-email-or-password-incorrect');
                        exit();
                    } elseif ($hashedPwdCheck == true) {
                        $_SESSION['id']    = $row['id'];
                        $_SESSION['name']  = $row['username'];
                        $_SESSION['email'] = $row['email'];
                        header('Location: index.php?login=success');
                        exit();
                    }
                }
            }
        }
    }
    
    if(isset($_POST["registersubmit"])){

    $name       = mysqli_real_escape_string($c, $_POST["username"]);
    $email      = mysqli_real_escape_string($c, $_POST["email"]);
    $password   = mysqli_real_escape_string($c, $_POST["password"]);
    
    // Error handlers
    // check for empty fields

    if (empty($name) || empty($email) || empty($password)) {
        header('Location: index.php?signup=empty-fields');
        exit();
    } else {
        // check if input character are valid
        if (!preg_match("/^[a-zA-Z]*$/", $name)) {
            header('Location: index.php?signup=invalid-name');
            exit();
        } else {
            // check if email is valid
             if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header('Location: index.php?signup=invalid-email');
                exit();
             } else {
                $sql         = "SELECT * FROM user WHERE email = '$email'";
                $result      = mysqli_query($c, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    header('Location: index.php?signup=email-already-exist');
                    exit();
                } else {
                    // Hashing the password
                    $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
                    // INSERT the user into the database
                    $sql = "INSERT INTO user (username,email,userpassword) VALUES ('$name', '$email', '$hashedpwd');";

                    mysqli_query($c, $sql);
                    header('Location: index.php?signup=success');
                    exit();
                }
             }
        }
    }   
}

?>
</div>

<div class="form-next-div">
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" id="loginform" >
    <div class="text-center">
        <h1 class="text-uppercase">Login</h1>
        <div class="green-line"></div>
    </div>
    <div class="mg-top-10 ">
        <label>Email</label><br>
        <input required type="email" name="email" class="form-control form-bottom" placeholder="enter your email address">
    </div>
    <div class="mg-top-10 ">
        <label>Password</label><br>
        <input required type="password" name="password" class="form-control form-bottom" placeholder="enter your password">
    </div>
    <div class="mg-top-10">
        <a href="reset_password.php">Forget Password?</a><p><p>
    </div>
    <div class="mg-top-10">
        <input  type="submit" name="loginsubmit" class="btn btn-primary btn-block form-button" value="Login">
    </div>
    <div class="text-center mg-top-10">
        <p>Haven't registered ? <a href="#" id="registerlink">Register Now</a></p>
        </div>
    </form>

    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="registerationform">
        <div class="text-center">
            <h2 class="text-uppercase">Register</h2>
        </div>
        <div class="mg-top-10 ">
            <label>Name</label><br>
            <input required type="text" name="username" class="form-control form-bottom" placeholder="enter your email address" value="">
            
        </div>
        <div class="mg-top-10 ">
            <label>Email</label><br>
            <input required type="email" name="email" class="form-control form-bottom" placeholder="enter your email address" value="">
        </div>
        <div class="mg-top-10 ">
            <label>Password</label><br>
            <input required type="password" name="password" class="form-control form-bottom" placeholder="create password" value="" >
        </div>
        <div class="mg-top-10 ">
            <input type="submit" name="registersubmit" class="btn btn-primary btn-block form-button" value="Register">
        </div>
        <div class="text-center mg-top-10">
            <p>Already registered ? <a href="#" id="loginlink">Login Now</a></p>
        </div>
    </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>

<?php
include("includes/footer.php");
?>