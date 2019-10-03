<?php
$delCommand = filter_input(INPUT_GET, 'delcom');
if (isset($delCommand) && $delCommand == 1) {
    $id = filter_input(INPUT_GET, 'id');
    if ($_SESSION['id'] == $id) {
        echo "<div>Cannot delete!</div><br>";
    } else {
        deleteUser($id);
    }
}

$submit = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submit)) {
    $username = filter_input(INPUT_POST, 'txtUsername');
    $password = filter_input(INPUT_POST, 'txtPassword');
    $repassword = filter_input(INPUT_POST, 'txtRePassword');
    $name = filter_input(INPUT_POST, 'txtName');
    $role = filter_input(INPUT_POST, 'roles');
    if ($password != $repassword) {
        echo "<div>Password not match!</div><br>";
    } else {
        addUser($username, md5($password), $name, $role);
    }
}
?>

<form method="post" id="usrform">
    <fieldset>
        <legend>New User</legend>
        <label for="txtNameIdx" class="form-label"></label>

        <b>Username</b><br>
        <input type="text" id="txtNameIdx" name="txtUsername" placeholder="Username" autofocus required class="form-input" size="80"><br><br>
        <b>Password</b><br>
        <input type="password" id="txtNameIdx" name="txtPassword" placeholder="Password" autofocus required class="form-input" size="80"><br><br>
        <b>Re-Type Password</b><br>
        <input type="password" id="txtNameIdx" name="txtRePassword" placeholder="Re-Type Password" autofocus required class="form-input" size="80"><br><br>
        <b>Name</b><br>
        <input type="text" id="txtNameIdx" name="txtName" placeholder="Name" autofocus required class="form-input" size="80"><br><br>
        <b>Role</b><br>

        <select name="roles">
            <?php
            $roles = getAllRole();
            foreach ($roles as $r) { ?>
                <option value=<?php echo $r['id']?>><?php echo $r['name']?></option>
            <?php }
            ?>
        </select><br><br>
        <input type="submit" name="btnSubmit" value="Add User" class="button-primary">
    </fieldset>
</form><br>

<table id="user" class="display">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Role</th>
        <th>Option</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $users = getAllUser();
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user['uid'] . '</td>';
        echo '<td>' . $user['username'] . '</td>';
        echo '<td>' . $user['uname'] . '</td>';
        echo '<td>' . $user['name'] . '</td>';
        if ($_SESSION['id'] == $user['uid']) {
            echo '<td align="center"><button onclick="updateUser(\'' . $user['uid'] . '\');">Update</button></td>';
        } else {
            echo '<td align="center"><button onclick="deleteUser(\'' . $user['uid'] . '\');">Delete</button><button onclick="updateUser(\'' . $user['uid'] . '\');">Update</button></td>';
        }
        echo '</tr>';
    }
    ?>
    </tbody>

</table>