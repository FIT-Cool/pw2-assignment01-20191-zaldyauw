<?php
$loginPressed = filter_input(INPUT_POST, 'btnLogin');
if (isset($loginPressed)) {
    $usnm = filter_input(INPUT_POST, 'txtUsername');
    $pwd = filter_input(INPUT_POST, 'txtPassword');
    $user = login($usnm, md5($pwd));
    if ($user != null && $user['username'] == $usnm) {
        $_SESSION['user_logged'] = true;
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role_id'];
        $_SESSION['id'] = $user['id'];
        header("location:index.php");
    } else {
        $errMsg = "Invalid username or password";
    }
}
if (isset($errMsg)) {
    echo '<div class="err-msg">' . $errMsg . '</div>';
}
?>

<form method="post">
    <fieldset>
        <legend>Login Form</legend>
        <label for="txtUsernameIdx"></label>
        <input id="txtUsernameIdx"
               name="txtUsername"
               type="text" autofocus required
               placeholder="Your Username"
               class="form-input">
        <label for="txtPasswordIdx"></label>
        <input id="txtPasswordIdx"
               name="txtPassword"
               type="password" autofocus required
               placeholder="Your Password"
               class="form-input">
        <input type="submit" name="btnLogin"
               value="Login" class="button button-primary">
    </fieldset>
</form>