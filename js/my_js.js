function deleteInsurance(id) {
    var confirm = window.confirm("Confirm delete data?");
    if (confirm) {
        window.location = "index.php?menu=ins&delIns=1&id=" + id;
    }
}

function deletePatient(med_record_number){
    var confirm = window.confirm("Confirm delete Patient?")
    if (confirm){
        window.location = "index.php?menu=pt&delPat=1&med_record_number=" + med_record_number;
    }
}

function updateInsurance(id){
    window.location = "index.php?menu=updIns&id=" + id;
}

function updatePatient(med_record_number){
    window.location="index.php?menu=updPat&med_record_number=" + med_record_number;
}