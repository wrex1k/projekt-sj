<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>login</title>
    <style>
        @font-face {
            font-family: Glacial;
            src: url(fonts/GlacialIndifference-Regular.otf);
        }

        body {
            margin: 0;
            padding: 0;
        }

        h2,
        a,
        input {
            font-family: Glacial;
            text-decoration: none;
            color: #fafafa;
        }

        input {
            color: black;
        }

        .container {
            display: flex;
            margin: 5vw 20vw;
            width: 900px;
            height: 500px;
        }

        .left-half img {
            height: 500px;
            width: 400px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .right-half {
            height: 500px;
            width: 500px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: rgba(14, 12, 12, 0.874);
        }

        form {
            display: flex;
            flex-direction: column;
            margin: 60px;
        }

        .password-wrapper {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .terms-wrapper {
            margin: 10px;
        }

        #firstname,
        #lastname,
        #email,
        #password,
        #re-password,
        .submit {
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .submit:hover {
            background-color: rgb(180, 180, 180);
        }

        .showpassword,
        .terms {
            width: 40px;
        }
    </style>

<body>
    <div class="container">
        <div class="left-half">
            <img src="img/login.jpg" alt="art" />
        </div>
        <div class="right-half">
            <div class="input-wrapper">
                <form method="POST" action="includes/loginHandler.php">
                    <h2>Login</h2>
                    <input id="email" type="email" name="email" placeholder="Email" required />
                    <div class="password-wrapper">
                        <input id="password" type="password" name="password" placeholder="Password" required>
                        <input type="checkbox" id="showpassword" class="showpassword"
                            onchange="togglePasswordVisibility()">
                    </div>
                    <input class="submit" type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var rePasswordInput = document.getElementById("re-password");
        var showPasswordCheckbox = document.getElementById("showpassword");

        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
            rePasswordInput.type = "text";
        } else {
            passwordInput.type = "password";
            rePasswordInput.type = "password";
        }
    }
</script>

</html>