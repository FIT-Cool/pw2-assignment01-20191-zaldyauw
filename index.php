<!DOCTYPE html>
<html>
<head>
    <title>Review PWL</title>
    <META CHARSET="UTF-8">
    <META LANG="EN">
    <meta name="author" content="zaldy">
    <meta name="description" content="web,php">
    <link rel="stylesheet" href="plugins/datatables.min.css">
    <link rel="stylesheet" href="plugins/hehe.css">
    <script type="text/javascript" src="plugins/datatables.min.js"></script>
</head>
<body>
<script language="JavaScript">
    function hitung() {
        var myForm = document.form1;
        var x=eval(myForm.x.value);
        var y=eval(myForm.y.value);
        var pil= myForm.opt.value;
        if (pil == "tambah") {
            var z = x + y;
        }else if (pil == "kurang") {
            var z = x - y;
        } else if (pil == "kali") {
            var z = x * y;
        } else if (pil == "bagi") {
            var z = x / y;
        }
        myForm.hasil.value = z;
        myForm.x.value = "";
        myForm.y.value = "";
    }
</script>
<table id="tableSaya">
    <thead>
        <tr>
            <th>haii</th>
            <th>haii</th>
            <th>haii</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>hi!</td>
            <td>hi!</td>
            <td>hi!</td>
        </tr>
        <tr>
            <td>hi!</td>
            <td>hi!</td>
            <td>hi!</td>
        </tr>
        <tr>
            <td>hi!</td>
            <td>hi!</td>
            <td>hi!</td>
        </tr>
    </tbody>
</table>
<div align="center">
    <form name="form1" action="#">
        <p>bil 1  <input type="text" name="x" /></p>
        <p>bil 2  <input type="text" name="y" /></p>
        <p>hasil  <input type="text" /></p>
        <p>operator <select name="opt"></p>
        <option value="tambah"> + (tambah)</option>
        <option value="kurang"> - (kurang)</option>
        <option value="kali"> * (kali)</option>
        <option value="bagi"> / (bagi)</option>
        </select>
        <input type="button" value="=" onClick="hitung()" />
    </form>
    <?php
     $angka1 = 25;
     $angka2 = 3.14;
     $isStudent =  true;
     if($angka1 >= 20){
         echo "angka lebih besar dari 20";
     }
    ?>
<script>
    $(document).ready( function () {
        $('#tableSaya').DataTable();
    } );
</script>
</body>
</html>