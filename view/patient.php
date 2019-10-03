<?php   //For Insert
$input = filter_input(INPUT_POST, "btnSubmit");
if (isset($input)){
    $med_record_number = filter_input(INPUT_POST, 'txtMRN');
    $citizen_id_number = filter_input(INPUT_POST, 'txtCIN');
    $name = filter_input(INPUT_POST, 'txtName');
    $address = filter_input(INPUT_POST, 'txtAddress');
    $birth_place = filter_input(INPUT_POST, 'txtBirthPlace');
    $birth_date = filter_input(INPUT_POST, 'txtBirthDate');
    $phone_number = filter_input(INPUT_POST, 'txtPhoneNumber');
    $photo = filter_input(INPUT_POST, 'txtPhoto');
    $insurance = filter_input(INPUT_POST, 'txtInsurance');
    if (fieldNotEmpty(array($med_record_number,$citizen_id_number,$name,$address,$birth_place,$birth_date,$phone_number,$photo,$insurance)))
    {
        if (isset($_FILES['txtPhoto']['name'])){
            $targetDirectory = 'uploads/';
            $targetFile = $targetDirectory. $med_record_number.'.'. pathinfo($_FILES['txtPhoto']['name'],PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['txtPhoto']['tmp_name'], $targetFile);
            //var_dump($targetFile);
            addPatient($med_record_number,$citizen_id_number,$name,$address,$birth_place,$birth_date,$phone_number,$targetFile,$insurance);

        }else {
            addPatient($med_record_number,$citizen_id_number,$name,$address,$birth_place,$birth_date,$phone_number,$insurance);
        }
    }else{
        $errMessage='please check your input';
    }


}
if (isset($errMessage)){
    echo '<div class="err-msg">'.$errMessage.'</div>';
}


//For Delete
$deleteCommand = filter_input(INPUT_GET, 'delPat');
if (isset($deleteCommand) && $deleteCommand == 1) {
    $med_record_number = filter_input(INPUT_GET, 'med_record_number');
    deletePatient($med_record_number);
}
?>

<table>
    <thead>
    <tr>
        <th>Record Number</th>
        <th>nama asuransi</th>
        <th>Id Number</th>
        <th>Name</th>
        <th>Address</th>
        <th>Birth Place</th>
        <th>Birth Date</th>
        <th>Phone Number</th>
        <th>Photo</th>

    </tr>
    </thead>

    <tbody>
    <form method="post" enctype="multipart/form-data">
        <fieldset>
            <legend> pasien baru </legend>
            <label>Med Record Number : </label>
            <input type="text" name="txtMRN" id="MRN" placeholder="Med Rec No. (isi)" autofocus required class="form-input"><br>
            <label>Id Number : </label>
            <input type="text" name="txtCIN" id="CIN" placeholder="13 Digit Number (isi)" autofocus required class="form-input"><br>
            <label>Name : </label>
            <input type="text" name="txtName" id="Name" placeholder="Name (isi)" autofocus required class="form-input"><br>
            <label>Address : </label>
            <input type="text" name="txtAddress" id="Address" placeholder="Address (isi)" autofocus required class="form-input"><br>
            <label>Birth Place : </label>
            <input type="text" name="txtBirthPlace" id="BirthPlace" placeholder="Birth Place (isi)" autofocus required class="form-input"><br>
            <label>Birth Date : </label>
            <input type="date" name="txtBirthDate" id="BirthDate" placeholder="Birth Date (isi)" autofocus required class="form-input"><br>
            <label>Phone Number : </label>
            <input type="text" name="txtPhoneNumber" id="PhoneNumber" placeholder="Phone Number (iis)" autofocus required class="form-input"><br>
            <input type="file" name="txtPhoto" id="Photo" placeholder="photo" autofocus required class="form-input"><br>
            <label>Jenis Asuransi </label>

            <select name="txtInsurance">
                <
                <?php
                $data = getAllInsurance();
                foreach ($data as $insurance) {
                    echo "<option value='".$insurance['id']."'>" . $insurance['name_class']."</option>" ;
                }
                ?>
            </select>
            <br>
            <input type="submit" name="btnSubmit" value="Add Patient" class="button button-primary">
        </fieldset>
    </form>

    <?php
    $data = getAllPatient();
    foreach ($data as $patient) {
        echo '<tr>';
        echo '<td>' . $patient['med_record_number'] . '</td>';
        echo '<td>' . $patient['name_class'] . '</td>';
        echo '<td>' . $patient['citizen_id_number'] . '</td>';
        echo '<td>' . $patient['name'] . '</td>';
        echo '<td>' . $patient['address'] . '</td>';
        echo '<td>' . $patient['birth_place'] . '</td>';
        echo '<td>' . date_format(date_create($patient['birth_date']), "d M Y") . '</td>';
        echo '<td>' . $patient['phone_number'] . '</td>';
        if (isset($patient['photo']) && file_exists($patient['photo'])){
            echo '<td><img src="' . $patient['photo'] . '" alt="photo" class="" style=""></td>';
        }else{
            echo '<td></td>';
        }
//        echo '<td>' . $patient['photo'] . '</td>';
        echo '<td><button onclick="deletePatient(\'' . $patient ['med_record_number'] . '\');">Delete</button><button onclick="updatePatient(\'' . $patient ['med_record_number'] . '\');">Update</button></td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>

