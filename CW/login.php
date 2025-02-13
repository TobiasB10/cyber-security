<?php
include("back_end/MasterPage.php");
include("back_end/sql.php");
$masterPage = new MasterPage("login");
echo $masterPage->createPage();

//generate HTML for login page
function createpage()
{
    $login = <<<LOGIN
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form method="POST" class="login">
                    <h1>Log In</h1>
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="Username" name="username" >
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Password" name="password" >
                    </div>
                    <button type="submit" class="button login__submit">
                        <span class="button__text">Log In</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <a class="button login__submit" href="register.php">
                        <span class="button__text">Register</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </a>
                    <a class="button login__submit" href="resetpass.php">
                        <span class="button__text">Forgot password?</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </a>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
LOGIN;
    return $login;
}


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($username) < 1) {
        echo "<script>alert('Username needs to be more than 1 character!'); window.location.href='login.php';</script>";
        exit();
    }
	// sql query to check password
    if ($stmt = $conn -> prepare("SELECT `id`, `password` FROM `user` WHERE BINARY `username` = ? LIMIT 1")) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $hash);
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            while ($stmt -> fetch()) {
                if (password_verify($password, $hash)) {
					session_start(); // Start the session
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $id;
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<script>alert('Incorrect username or password!'); window.location.href='login.php';</script>";
                    exit();
                }
            }
        } 
        $stmt->close();
    } 
}

echo createpage();
?>