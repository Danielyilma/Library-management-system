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
            <div id="btn" style="left: 110px; "></div>
            <button type="button" class="toggle-btn" id="log" onclick="location.href='login.php'" style="color:black">
                Log In
            </button>
            <button type="button" onclick="location.href='signup.php'" class="toggle-btn" id="reg" style="color:#fff">
                Sign Up
            </button>
        </div>

        <!-- Registration Form -->
        <form action="home.php" id="register" class="input-group">
            <input type="text" class="input-field" placeholder="Full Name" required="required" />
            <input type="text" class="input-field" placeholder="Email Address" required="required" />
            <input type="text" class="input-field" placeholder="Create Password" name="psame" required="required" />
            <input type="text" class="input-field" placeholder="Confirm Password" name="psame" required="required" />
            <button type="submit" id="btnSubmit" class="submit-btn reg-btn">
                Register
            </button>
        </form>

    </div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>