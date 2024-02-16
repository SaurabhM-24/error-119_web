<?php
require 'config.php';

if(isset($_POST['submit_registration'])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rpassword=$_POST["repeat_password"];
    $duplicate = mysqli_query($conn, "SELECT * FROM er1 WHERE username = '$username' OR email = '$email'"); 
    if (mysqli_num_rows($duplicate) > 0) { 
        echo "<script> alert('Username or Email already exists'); </script>";
    } else {
        if($password==$rpassword){
        // $query = "INSERT INTO er1 (username, email, password) VALUES ('$username', '$email', '$password')";
        $query = mysqli_query($conn, "INSERT INTO er1 (username, email, password) VALUES ('$username', '$email', '$password')");
        if ($query) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = mysqli_insert_id($conn);
            header("Location: loginn.php");
            echo 'Registration successful';
        } else {
            echo 'Registration failed. Error: ' . mysqli_error($conn);
        }
        }else{
            echo "<script> alert('Please enter same Password'); </script>";
        } 
    }
}
if(isset($_POST["submit_login"])){
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM er1 WHERE username='$usernameemail' OR email= '$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){
            $_SESSION["login"]=true;
            $_SESSION["id"] = $row["id"];
            header("Location: dashboard.php");
        }
        else{
            echo "<script> alert ('wrong password');</script>";
        }
    }
    else{
        echo "<script> alert ('user register nhi hai');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Black Ops One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Paytone One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
    <title>Sign-up</title>
</head>
<body>
    <div class="header">
        
        <img src="https://i.postimg.cc/T3G1Y1Yz/new-logo.png">
        <ul>
            
            <li><a href="#"> COURSES</a></li>
            <li><a href="#"> ROADMAPS</a></li>
            <li><a href="#"> ABOUT US</a></li>
        </ul>
        <div class="btn">
            <button>DASHBOARD</button>
        </div>
    </div>
    <hr id="border-line">


    <div class="center-block1">
        <div class="title">
            <h1>ERROR - 119</h1>
        </div>
        <div class="login-block">

            <div class="login-elements">

            <!-- <h3>Sign-up</h3> -->
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" id="loginbtn" class="toggle-btn" onclick="login()"> Log In</button>
                <button type="button" id="signupbtn" class="toggle-btn" onclick="signup()"> Sign-Up</button>
            </div>
            <div class="form-box">
            <form id="login" action="" method="post">
                <label id="fname" for="fname">Username or E-mail</label> <br>
                <input type="text" id="fname" name="usernameemail" ><br><br>
                <label for="lname">Password</label> <br>
                <input type="text" id="lname" name="password"><br><br>
                <button type="submit" name="submit_login" id="submit-button">Login Now <i class="bi bi-arrow-right"></i></button> 
                <a href="forget.php" id="forgot-passcode">Forgot Passcode</a>
              </form>

            <form id="signup" action="" method="post">
                <label id="fname" for="fname">User-Name</label> <br>
                <input type="text" id="fname" name="username" ><br><br>
                <label for="lname">Email</label> <br>
                <input type="text" id="lname" name="email"><br><br>
                <label for="lname">Password</label> <br>
                <input type="text" id="lname" name="password"><br><br>
                <input type="text" id="lname" name="repeat_password" placeholder="Repeat-Password"><br><br>
                <button type="submit" name="submit_registration" id="submit-button">Sign-Up <i class="bi bi-arrow-right"></i></button> 
              </form>


            </div>



            </div>
        </div>
    </div>
</body>

<script>
    var x = document.getElementById("login")
    var y = document.getElementById("signup")
    var z = document.getElementById("btn")
    var signupbtn = document.getElementById("signupbtn");
    var loginbtn = document.getElementById("loginbtn");

    function signup(){
        x.style.top = "-300px";
        y.style.top = "-210px";
        z.style.left = "108px";
        signupbtn.style.color = "white";
        loginbtn.style.color = "black";
    }
    function login(){
        x.style.top = "60px";
        y.style.top = "300px";
        z.style.left = "0px";
        loginbtn.style.color = "white";
        signupbtn.style.color = "black"
    }
</script>

<style>
    #signupbtn{
        color: black;
    }
    .form-box{
        overflow: hidden;
        /* border: 1px solid black; */
        height: 30rem;
        width: 24rem;
    }

    #login{
        position:relative;
        top: 60px;
        /* top:-300px; */
    }
    #signup{
        position: relative;
        top: 300px;
        /* top: -170px; */
    }
    #btn{
        /* left: 105px; */
    }



    /* ------------------------------------------------------Login - Sign-up Button------------------------ */
    .button-box{
            box-shadow: 0 0 30px 5px black;
            margin-top: 10%;
            width: 61%;
            height: 2.8rem;
            
            border-radius: 10px;
            transform: translateX(50%);
            position: relative;
            left: -10%;
            /* border: 1px solid black; */
            
        }
        .toggle-btn{
            height: 2.5rem;
            color: white;
            padding: 10px 30px;
            cursor: pointer;
            background: transparent;
            border: 0;
            outline: none;
            position: relative;
            font-size: rem;
            font-family: 'Lexend';
        }
        #btn{
            top: 0;
            /* left: 0; */
            position: absolute;
            width: 7rem;
            height: 100%;
            background-color: black;
            /* background: linear-gradient(to right, white, black); */
            border-radius: 10px;
            transition: 0.5s;
        }









    /* ------------------------------------------------------Login - Sign-up Button------------------------ */






    /* -------------------------------------------------{center - block }--------------------------------------------------------- */
    .center-block1 h1{
        color: white;
        font-family: 'Black ops one';
        font-size: 6rem;
        
    }
    .center-block1{
        display: flex;
        /* border: 1px solid white; */
        width: 90vw;
        height: 34.5rem;
        margin-left: 5%;
        margin-top: 6%;

    }
    .login-block{
        border: 1px solid white;
        width: 25vw;
        /* padding-top: 1rem; */
        /* padding-left: 20px; */
        margin-left: 31%;
        border-radius: 20px;
        background-color: white;
        box-shadow: 0px 0px 40px rgb(208, 203, 203);
    }
    .login-block h3{
        /* color: white; */
        font-family: 'Paytone One';
        font-size: 2rem;
        /* padding-left: 2rem; */
        
    }
    .login-block #forgot-passcode{
        font-family: 'lexend';
        text-decoration: underline;
        margin-left: 5rem;
        cursor: pointer;
    }
    .login-block #forgot-passcode:hover{
        
    }
    .login-elements #submit-button{
        margin-top: 10px;
        height: 3.2rem;
        border:none;   
        cursor: pointer;
     }
    


    /* -----------------------------Login elements----------------------------------- */
    .login-elements{
        /* border: 1px solid black; */
        width: 20.5vw;
        margin-left: 2.5rem;
        margin-right: 2.5rem;
        
        
        
    }

    .login-elements input{
        width: 22.2rem;
        height: 3rem;
        border-radius: 10px;
        border: 1px solid rgb(111, 109, 109);
        margin-top: 2px;
        font-family: 'Lexend';
        font-weight: bold;
        padding-left: 10px;
        font-size: 1rem;
    }
    .login-elements label{
        opacity: 80%;
        font-family: 'lexend';
        font-weight: bold;
        
    }

    .login-elements #submit-button{
        width: 8vw;
        border-radius: 8px;
        background-color: black;
        color: white;
        font-family: 'lexend';
        font-weight: bold;
    }













    /* --------------------------------------------------HEADER----------------------------------------------------------------------- */
    .block-line{
        background-color: white;
        width: 30vw;
        height: 2vw;
        margin-left: 65%;
        margin-right: 10%;
        position: absolute;
        top: 540px;
        border-radius: 0px 0px 0px 18px;
    }
    body{
            background: black;
        }
        .header img{
            width: 15%;
            cursor: pointer;
            margin-left: 3%;
        }
        .header a{
            text-decoration: none;
            color: rgb(243, 230, 230);
            font-family: 'Roboto';
            font-size: 15px;
            font-weight: bold;

        }
        .header{
            display: flex;
            /* border: 1px solid white; */
        }
        .header ul{
            margin-top: 1%;
            display: flex;
            width: 40%;
            /* border: 1px solid white; */
            margin-left: 12%;
            
            
        }
        .header ul li{
            margin-left: 12%;
            margin-top: 4%;
            opacity: 85%;
        }
        .header .btn button{
            height: 50%;
            width: 150%;
            border-radius: 10px;
            margin-top: 25%;
            background-color: black;
            color: white;
            border: 2px solid white;
            font-weight: bold;
            cursor: pointer;
        }
        .header .btn{
            margin-left: 13%;
        }
        #border-line{
            opacity: 50%;
            border-radius: 100%;
            width: 80%;
        }


</style>
</html>