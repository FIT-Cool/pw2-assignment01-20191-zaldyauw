<?php
//For data fetch
$med_record_number = filter_input(INPUT_GET, 'med_record_number');
if (isset($med_record_number)) {
    $patient = getPatient($med_record_number);
}

//For Update
$input = filter_input(INPUT_POST, "btnUpdate");
if (isset($input)) {
    $medrecordnumber = filter_input(INPUT_POST, 'txtMRN');
    $citizenidnumber = filter_input(INPUT_POST, 'txtCIN');
    $name = filter_input(INPUT_POST, 'txtName');
    $address = filter_input(INPUT_POST, 'txtAddress');
    $birthplace = filter_input(INPUT_POST, 'txtBirthPlace');
    $birthdate = filter_input(INPUT_POST, 'txtBirthDate');
    $phonenumber = filter_input(INPUT_POST, 'txtPhoneNumber');
    $photo = filter_input(INPUT_POST, 'txtPhoto');
    $insurance = filter_input(INPUT_POST, 'txtInsurance');
    if (fieldNotEmpty(array($medrecordnumber,$citizenidnumber,$name,$address,$birthplace,$birthdate,$phonenumber,$photo,$insurance)))
    {
        if (isset($_FILES['txtPhoto']['name'])){
            $targetDirectory = 'uploads/';
            $targetFile = $targetDirectory. $medrecordnumber.'.'. pathinfo($_FILES['txtPhoto']['name'],PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['txtPhoto']['tmp_name'], $targetFile);
            //var_dump($targetFile);
            updatePatient($medrecordnumber,$citizenidnumber,$name,$address,$birthplace,$birthdate,$phonenumber,$targetFile,$insurance);

        }else {
            updatePatient($medrecordnumber,$citizenidnumber,$name,$address,$birthplace,$birthdate,$phonenumber,$insurance);
        }
    }else{
        $errMessage='please check your input';
    }


}
if (isset($errMessage)){
    echo '<div class="err-msg">'.$errMessage.'</div>';
}

?>

<form method="post" enctype="multipart/form-data">
    <fieldset>
        <legend> Update Patient</legend>
        <label> Patient Name </label>
        <label>Med Record Number : </label>
        <input type="text" name="txtMRN" id="MRN" placeholder="(isi)" autofocus required class="form-input" value="<?php echo $patient['med_record_number']; ?>" readonly>
        <label>Id Number : </label>
        <input type="text" name="txtCIN" id="CIN" placeholder="(isi)" required class="form-input">
        <label>Name : </label>
        <input type="text" name="txtName" id="Name" placeholder="(isi)" autofocus required class="form-input">
        <label>Address : </label>
        <input type="text" name="txtAddress" id="Address" placeholder="(isi)" autofocus required class="form-input">
        <label>Birth Place : </label>
        <input type="text" name="txtBirthPlace" id="BirthPlace" placeholder="(isi)" autofocus required class="form-input">
        <label>Birth Date : </label>
        <input type="date" name="txtBirthDate" id="BirthDate" placeholder="(isi)" autofocus required class="form-input">
        <label>Phone Number : </label>
        <input type="text" name="txtPhoneNumber" id="PhoneNumber" placeholder="(isi)" autofocus required class="form-input">
        <label>Photo : </label>
        <input type="file" name="txtPhoto" id="Photo" placeholder="(isi)" autofocus required class="form-input">
        <select name="txtInsurance">
            <?php
            $data = getAllInsurance();
            foreach ($data as $insurance) {
                echo "<option value='".$insurance['id']."'>" . $insurance['name_class']."</option>" ;
            }
            ?>
        </select>
        <input type="submit" name="btnUpdate" value="Update Patient" class="button button-primary">
    </fieldset>
</form>
