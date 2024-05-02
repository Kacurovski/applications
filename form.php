<?php 
include ('./connection.php');
$academies = "SELECT * FROM `academies`";
$allAcademies = mysqli_query($connection, $academies);

if(mysqli_num_rows($allAcademies) > 0){
    $dataAcademy = array();
    while($rowAcademy = mysqli_fetch_assoc($allAcademies)){
        $dataAcademy[] = $rowAcademy;
    }
}
else{
    $noAcademies = "There are no academies in the database";
}

// Clear form inputs
$name = $email = $companyName = $tel = $studentType = '';

// Create form errors as blank
$errors = array('name' => '', 'email' => '', 'companyName' => '', 'tel' => '', 'studentType' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST['name'])) {
        $errors['name'] = 'Ве молиме внесете го вашето име и презиме <i class="fa-solid fa-circle-exclamation"></i>';
    } else {
        $name = $_POST['name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] = 'Неможе да внесете бројки и симболи во име и презиме <i class="fa-solid fa-circle-exclamation"></i>';
        }
    }

    // Check email validators
    if (empty($_POST['email'])) {
        $errors['email'] = 'Ве молиме внесете имејл адреса <i class="fa-solid fa-circle-exclamation"></i>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Ве молиме внесете валидна имејл адреса (user@mydomain.com) <i class="fa-solid fa-circle-exclamation"></i>';
        }
    }

    // Check companyName validators
    if (empty($_POST['companyName'])) {
        $errors['companyName'] = 'Ве молиме внесете го името на вашата компанија <i class="fa-solid fa-circle-exclamation"></i>';
    } else {
        $companyName = $_POST['companyName'];
    }

    // Check tel validators
    if (empty($_POST['tel'])) {
        $errors['tel'] = 'Ве молиме внесете го вашиот телефонски број <i class="fa-solid fa-circle-exclamation"></i>';
    } else {
        $tel = $_POST['tel'];
        if (!preg_match('/^[0-9]+$/', $tel)) {
            $errors['tel'] = 'Внесете валиден телефонски број <i class="fa-solid fa-circle-exclamation"></i>';
        }
    }

    // Check studentType validators
    if (empty($_POST['studentType'])) {
        $errors['studentType'] = 'Ве молиме селектирајте тип на студент <i class="fa-solid fa-circle-exclamation"></i>';
    } else {
        $studentType = $_POST['studentType'];
    }

    if (!array_filter($errors)) {
        $data = "INSERT INTO `form-info`(`name`, `companyName`, `email`, `tel`, `studentType`) VALUES ('$name','$companyName','$email','$tel','$studentType')";
        $result = mysqli_query($connection, $data);
        if ($result) {
            setcookie('submitedForm', 'true', time() + 60 * 60 * 24 * 30);
            header('Location: formPage.php');
            exit;
        } else {

        }
    }
    else{
        $submitButtonBoxCss = 'align-items-center mt-2';
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("modalButton").click();
        });
    </script>';
    }
}

mysqli_close($connection);
?>

<form method="POST" class="text-dark pb-4" id="form">
    <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="name" class="form-label h5">Име и презиме</label>
            <input type="text" class="form-control p-3" id="name" name="name" aria-describedby="nameHelp" placeholder="Вашето име и презиме" value="<?php echo $name?>">
            <p class="formError text-danger fw-bold"><?php echo $errors['name']?></p>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="companyName" class="form-label h5">Име на компанија</label>
            <input type="text" class="form-control p-3" id="companyName" name="companyName" aria-describedby="companyNameHelp" placeholder="Име на вашата компанија" value="<?php echo $companyName?>">
            <p class="formError text-danger fw-bold"><?php echo $errors['companyName']?></p>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="email" class="form-label h5">Контакт имејл</label>
            <input type="email" class="form-control p-3" id="email" name="email" aria-describedby="emailHelp" placeholder="Контакт имејл на вашата компанија" value="<?php echo $email?>">
            <p class="formError text-danger fw-bold"><?php echo $errors['email']?></p>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="contactTel" class="form-label h5">Контакт телефон</label>
            <input type="tel" class="form-control p-3" id="contactTel" name="tel" aria-describedby="contactTelHelp" placeholder="Контакт телефон на вашата компанија" value="<?php echo $tel?>">
            <p class="formError text-danger fw-bold"><?php echo $errors['tel']?></p>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <label for="name" class="form-label h5 m-0">Тип на студенти</label>
            <select class="form-select mt-2 p-3" name="studentType" aria-label="Default select example" value="<?php echo $studentType?>">
            <option selected disabled>Изберете тип на студент</option>
            <?php foreach ($dataAcademy as $row) : ?>
            <option><?php echo $row['academyName']; ?></option>
            <?php endforeach; ?>
            </select>
            <p class="formError text-danger fw-bold m-0"><?php echo $errors['studentType']?></p>
        </div>
        <div class="col-lg-6 d-flex align-items-end <?php echo $submitButtonBoxCss ?>">
            <button type="submit" class="btn btn-danger w-100 fw-bold p-3" id="submitButton">Испрати</button>
        </div>
    </div>
</form>


