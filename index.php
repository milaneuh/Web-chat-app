<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ProjetAnnexe</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>
<body>
<div class="wrapper">
    <section class="form signup">
        <header>Welcome to Bee Message ! <br> Create New Account</header>
        <form action="#" enctype="multipart/form-data">
            <div class="errorTxt">
                This is an error message
            </div>
            <div class="profileImage">
                <div class="fields">
                    <label>Select Profile Image</label>
                    <input type="file" name="image" required>
                </div>
            </div>
            <div class="input">
                <div class="fields">
                    <input type="email" name="email" placeholder="Email" required >
                </div>
            </div>
            <div class="input">
                <div class="fields">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
            </div>
            <div class="input">
                <div class="fields">
                    <input type="password"  id="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <div class="input">
                <div class="fields">
                    <input type="password"  name="confirmPassword" placeholder="Confirm Password" required>
                </div>
            </div>

            <div class="fields button">
                <input id="signupBtnInput" type="submit" value="SIGN UP" >
            </div>
        </form>
        <div class="link"><a href="login.php">Already Have An Account</a></div>
    </section>
</div>
<script src="javascript/signup.js"></script>
</body>
</html>