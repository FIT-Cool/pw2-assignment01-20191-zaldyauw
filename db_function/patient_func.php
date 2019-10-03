<?php
function getAllPatient()
{
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT p.med_record_number, i.name_class, p.citizen_id_number, p.name, p.address, p.birth_place, p.birth_date, p.phone_number, p.photo
                FROM patient p 
                JOIN insurance i
                ON p.insurance_id = i.id
                ORDER BY med_record_number";
    $result = $link->query($query);
    $link = null;
    return $result;
}

function addPatient($MRN, $CIN, $Name, $Address, $BirthPlace, $BirthDate, $PhoneNumber, $Photo, $InsuranceId){
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO patient(med_record_number, citizen_id_number, name, address, birth_place, birth_date, phone_number, photo, insurance_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $link->prepare($query);
    $statement = $link->prepare($query);
    $statement->bindParam(1,$MRN, PDO::PARAM_STR);
    $statement->bindParam(2,$CIN, PDO::PARAM_STR);
    $statement->bindParam(3,$Name, PDO::PARAM_STR);
    $statement->bindParam(4,$Address, PDO::PARAM_STR);
    $statement->bindParam(5,$BirthPlace, PDO::PARAM_STR);
    $statement->bindParam(6,$BirthDate, PDO::PARAM_STR);
    $statement->bindParam(7,$PhoneNumber, PDO::PARAM_STR);
    $statement->bindParam(8,$Photo, PDO::PARAM_STR);
    $statement->bindParam(9,$InsuranceId, PDO::PARAM_STR);
    $link->beginTransaction();
    if ($statement->execute()){
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}

function deletePatient($med_record_number){
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "DELETE FROM patient WHERE med_record_number = ?";
    $link->prepare($query);
    $statement = $link->prepare($query);
    $statement->bindParam(1, $med_record_number, PDO::PARAM_STR);
    $link->beginTransaction();
    if ($statement->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}

function updatePatient($medrecordnumber, $citizenidnumber, $name, $address, $birthplace, $birthdate, $phonenumber, $photo, $insuranceid){
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "UPDATE patient SET med_record_number=?, citizen_id_number=?, name=?, address=?, birth_place=?, birth_date=?, phone_number=?, photo=?, insurance_id=? WHERE med_record_number=?";
    $link->prepare($query);
    $statement = $link->prepare($query);
    $statement->bindParam(1, $medrecordnumber, PDO::PARAM_STR);
    $statement->bindParam(2, $citizenidnumber, PDO::PARAM_STR);
    $statement->bindParam(3, $name, PDO::PARAM_STR);
    $statement->bindParam(4, $address, PDO::PARAM_STR);
    $statement->bindParam(5, $birthplace, PDO::PARAM_STR);
    $statement->bindParam(6, $birthdate, PDO::PARAM_STR);
    $statement->bindParam(7, $phonenumber, PDO::PARAM_STR);
    $statement->bindParam(8, $photo, PDO::PARAM_STR);
    $statement->bindParam(9, $insuranceid, PDO::PARAM_INT);
    $statement->bindParam(10, $medrecordnumber, PDO::PARAM_STR);
    $link->beginTransaction();
    if ($statement->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}

function getPatient($med_record_number){
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM patient WHERE med_record_number = ? LIMIT 1";
    $statement = $link -> prepare($query);
    $statement->bindParam(1, $med_record_number, PDO::PARAM_STR);
    $statement -> execute();
    $result = $statement -> fetch();
    $link = null;
    return $result;
}
?>
