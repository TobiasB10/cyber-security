<?php
include("back_end/MasterPage.php");
include("back_end/sql.php");

$masterPage = new MasterPage("Home");
echo $masterPage->createPage();
//generate HTML for register page
function createpage()
{
$reg = <<<REG
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form method="POST" class="login">
			<h1>Register</h1>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="Email" name="email">
				</div>
        <div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="Username" name="username">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Password" name="password">
				</div>
        <div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Retype password" name="pass-repeat">
				</div>
				<button class="button login__submit">
					<span class="button__text">Register</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>	
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

REG;
return $reg;
}

// only runs this code if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $email = $_POST['email'];
    $username = $_POST['username'];
	$password = $_POST['password'];
    $pass_repeat = $_POST['pass-repeat'];

    // Validate email length
		if (strlen($email) < 1 || strlen($email) > 50) 
		{
			if (strlen($email) < 1) {
				echo "<script>alert('Email length too short'); window.location.href='register.php'</script>";
			} else {
				echo "<script>alert('Email length too long'); window.location.href='register.php'</script>";
			}
			exit();
		}
		else if (strpos($email, '@') == false)
		{
			echo "<script>alert('Email requires @'); window.location.href='register.php'</script>";
			exit();
		}
		else if (strlen($password) < 10)
		{
			echo "<script>alert('password needs to be 10 or more characters!'); window.location.href='register.php'</script>";
			exit();
		}
		else if ($password !== $pass_repeat)
		{
		echo "<script>alert('passwords do not match!'); window.location.href='register.php'</script>";
		exit();
		}
		else if (strlen($username) < 1)
		{
			echo "<script>alert('username needs to be more than 1 character!'); window.location.href='register.php'</script>";
			exit();
		}
			// Check if username already exists
			if ($stmt = $conn -> prepare("SELECT `id` FROM `user` WHERE `username` = ? LIMIT 1")) {
				$stmt->bind_param("s", $username);
				$stmt->execute();
				$stmt->store_result();
		
				if ($stmt->num_rows > 0) {
					echo "<script>alert('Username already taken!'); window.location.href='register.php';</script>";
					$stmt->close();
					exit();
				}
				$stmt->close();
			}
		
		
			// hashes password and sends user info to database
			$hash = password_hash($password, PASSWORD_DEFAULT);
			if ($stmt = $conn -> prepare ("INSERT INTO `user` (`email`, `username`, `password`) VALUES (?, ?, ?)"))
			{
				$stmt -> bind_param("sss", $email, $username, $hash);
				$stmt -> execute();

				if ($stmt -> insert_id == 0)
				{
					echo "<script>alert('database error!'); window.location.href='register.php'</script>";
					exit();
				}

				$stmt -> close();
				header ("Location: login.php");
				
			}
}

echo createpage();
















?>