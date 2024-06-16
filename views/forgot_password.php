<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="stylesheet" type="text/css" href="views/static/css/loginsty.css"/>
</head>
<body>
    <div class="form-box">
        <div class="button-box">
            <h2>Forgot password</h2>
        </div>

        <?php if ($password_reset) : ?>
            <form method='post' action="/reset_password" id="register" class="input-group">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="password" class="input-field" placeholder="Create Password" name="password" required="required" />
                <input type="password" class="input-field" placeholder="Confirm Password" name="psame" required="required" />
                <button type="submit" id="btnSubmit" class="submit-btn reg-btn">
                    Reset password
                </button>
            </form>
        <?php else : ?>
            <form method="post" id="login" class="input-group" action="/reset_password">
                <div class="inp">
                    <input type="email" name='email' id="email" class="input-field" placeholder="Email" style="width: 88%; border: none" required="required" />
                </div>
                <button type="submit" class="submit-btn">submit</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>