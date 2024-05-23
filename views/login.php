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
            <div id="btn" style="left: 0"></div>
            <button type="button" class="toggle-btn" id="log" onclick="location.href='/login'" style="color: #fff">
                Log In
            </button>
            <button type="button" onclick="location.href='/signup'" class="toggle-btn" id="reg" style="color:black">
                Sign Up
            </button>
        </div>


        <!-- Login Form -->
        <form method="post" id="login" class="input-group" action="/login">
            <div class="inp">
                <input type="email" name='email' id="email" class="input-field" placeholder="Email" style="width: 88%; border: none" required="required" />
            </div>
            <div class="inp">
                <input type="password" name='password' id="password" class="input-field" placeholder="Password" style="width: 88%; border: none" required="required" />
            </div>
            <button type="submit" class="submit-btn">Log In</button>
        </form>

    </div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>