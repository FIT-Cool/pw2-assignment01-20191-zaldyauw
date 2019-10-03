<?php //For Insert
$input = filter_input(INPUT_POST, "btnSubmit");
if (isset($input)){
    $name = filter_input(INPUT_POST, 'txtName');
    addInsurance($name);
}

//For Delete
$deleteCommand = filter_input(INPUT_GET, 'delIns');
if (isset($deleteCommand) && $deleteCommand == 1) {
    $id = filter_input(INPUT_GET, 'id');
    deleteInsurance($id);
}
?>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
    </tr>
    </thead>

    <tbody>
    <form method="post">
        <fieldset>
            <legend> Asuransi Baru </legend>
            <label>Nama Asuransi : </label>
            <input type="text" name="txtName" id="insuranceId" placeholder="Name (ex. SunLife Platinum)" autofocus required class="form-input">
            <input type="submit" name="btnSubmit" value="Add Insurance" class="button button-primary">
        </fieldset>
    </form>

    <?php
    $data = getAllInsurance();
    foreach ($data as $insurance) {
        echo '<tr>';
        echo '<td>' . $insurance['id'] . '</td>';
        echo '<td>' . $insurance['name_class'] . '</td>';
        echo '<td><button onclick="deleteInsurance(' . $insurance ['id'] . ');"> Delete </button><button onclick="updateInsurance(' . $insurance ['id'] . ');"> Update </button></td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>

