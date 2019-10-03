<?php
$id = filter_input(INPUT_GET, 'id');
if (isset($id)) {
    $user = getUser($id);
}
$submitted = filter_input(INPUT_POST, 'btnUpdate');
if (isset($submitted)) {
    $username = filter_input(INPUT_POST, 'txtUsername');
    $password = filter_input(INPUT_POST, 'txtPassword');
    $repassword = filter_input(INPUT_POST, 'txtRePassword');
    $name = filter_input(INPUT_POST, 'txtName');
    $role = filter_input(INPUT_POST, 'txtRole');
    if ($password != $repassword) {
        echo "<div>Password not match!</div><br>";
    } else {
        updateUser($id, $username, md5($password), $name, $role);
        header("location:index.php?menu=u");
    }
}
?>

<form method="post" id="usrform">
    <fieldset>
        <legend>Update User</legend>
        <label for="txtNameIdx" class="form-label"></label>

        <b>Username</b><br>
        <input type="text" id="txtNameIdx" name="txtUsername"
               placeholder="Username" autofocus required
               class="form-input" size="80"
               value="<?php echo $user['username'];?>"><br><br>
        <b>Name</b><br>
        <input type="text" id="txtNameIdx" name="txtName"
               placeholder="Name" autofocus required
               class="form-input" size="80"
               value="<?php echo $user['uname'];?>"><br><br>
        <b>Password</b><br>
        <input type="password" id="txtNameIdx" name="txtPassword"
               placeholder="Password" autofocus required
               class="form-input" size="80"
        ><br><br>
        <b>Re-Type Password</b><br>
        <input type="password" id="txtNameIdx" name="txtRePassword"
               placeholder="Re-Type Password" autofocus required
               class="form-input" size="80"
        ><br><br>
        <b>Role</b><br>
        <select name="roles">
            <?php
            $roles = getAllRole();
            foreach ($roles as $r) { ?>
                <option value=<?php echo $r['id']?>><?php echo $r['name']?></option>
            <?php }
            ?>
        </select><br><br>
        <input type="submit" name="btnUpdate" value="Update User" class="button-primary">
    </fieldset>
</form>