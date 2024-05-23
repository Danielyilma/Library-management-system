<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" type="png" href="images/icon/favicon.png" />
    <title>Login SignUp</title>
    <link rel="stylesheet" type="text/css" href="views/static/css/loginsty.css" />
</head>

<body>
    <div class="form-box">
        <div class="button-box">
            <div id="btn" style="left: 110px; "></div>
            <button type="button" class="toggle-btn" id="log" onclick="location.href='/login'" style="color:black">
                Log In
            </button>
            <button type="button" onclick="location.href='/signup'" class="toggle-btn" id="reg" style="color:#fff">
                Sign Up
            </button>
        </div>

        <!-- Registration Form -->
        <form method='post' action="/signup" id="register" class="input-group">
            <input type="text" class="input-field" name="name" placeholder="Full Name" required="required" />
            <input type="email" class="input-field" name="email" placeholder="Email Address" required="required" />
            <input type="text" class="input-field" placeholder="Phone Number" name="phone_number" required="required" />
            <input type="password" class="input-field" placeholder="Create Password" name="password" required="required" />
            <input type="password" class="input-field" placeholder="Confirm Password" name="psame" required="required" />
            <button type="submit" id="btnSubmit" class="submit-btn reg-btn">
                Register
            </button>
        </form>

    </div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>