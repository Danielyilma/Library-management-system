<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" type="png" href="images/icon/favicon.png" />
    <title>Login SignUp</title>
    <link rel="stylesheet" type="text/css" href="css/loginsty.css" />
</head>

<body>
    <div class="form-box">


        <div class="button-box">
            <div id="btn" style="left: 0"></div>
            <button type="button" class="toggle-btn" id="log" onclick="location.href='login.php'" style="color: #fff">
                Log In
            </button>
            <button type="button" onclick="location.href='signup.php'" class="toggle-btn" id="reg" style="color:black">
                Sign Up
            </button>
        </div>

        <!-- Login Form -->
        <form id="login" class="input-group" action="home.php">
            <div class="inp">
                <input type="text" id="email" class="input-field" placeholder="Username or Phone Number" style="width: 88%; border: none" required="required" />
            </div>
            <div class="inp">
                <input type="text" id="password" class="input-field" placeholder="Password" style="width: 88%; border: none" required="required" />
            </div>
            <button type="submit" class="submit-btn">Log In</button>
        </form>

    </div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>