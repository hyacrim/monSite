<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../db.php');
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $sexe = $_POST['sexe'];
    $date = $_POST['date'];

    // Initialisation des messages d'erreur
    $errorMessageUser = "";
    $errorMessageEmail = "";
    $errorMessage = "";

    // Vérifier si l'utilisateur existe déjà dans la base de données
    $userCheckQuery = "SELECT * FROM utilisateur WHERE username = '$username'";
    $userCheckResult = $conn->query($userCheckQuery);

    // Vérifier si l'adresse e-mail existe déjà dans la base de données
    $emailCheckQuery = "SELECT * FROM utilisateur WHERE email = '$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($userCheckResult->num_rows > 0) {
        $errorMessageUser = "L'utilisateur existe déjà!";
    }

    if ($emailCheckResult->num_rows > 0) {
        $errorMessageEmail = "L'adresse e-mail existe déjà!";
    }

    if ($password !== $cpassword) {
        $errorMessage = "Les mots de passe sont différents!";
    }

    if (empty($errorMessageUser) && empty($errorMessageEmail) && empty($errorMessage)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe

        $sql = "INSERT INTO utilisateur (username, email, password, sexe, datenaissance) VALUES ('$username', '$email', '$hashedPassword', '$sexe', '$date' )";
        $result = $conn->query($sql);

        if ($result === TRUE) {
            echo header("Location:register.php?message=yes");
            exit();
        } else {
            echo header("Location:register.php?message=no");
        }

        $conn->close();
    }
}
    
?>

<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vos informations</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
<div class="wrapper">
    <h2>Vos informations</h2>
     <!-- Alert -->
     <?php
     if(isset($_GET["message"]) && $_GET["message"] == "yes"){
        ?>
        <script>
           setTimeout(function() {
               window.location.href = '../login/login.php';
           }, 7000); // Redirige après 5 secondes
       </script>
        <div class="alert sucess">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong style="text-align: center">succès!</strong><br> Nous avons enregistré vos informations! <br>
        <strong style="text-align: center" > <h3 style="color: yellow">Veuillez patienter quelques secondes!</h3></strong>
     </div>

       <?php
     }else if(isset($_GET["message"]) && $_GET["message"] == "no"){
        ?>
        <div class="alert fail">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Fail!</strong><br> Nous n'avons pas pu enregistrer vos informations!
        <strong style="text-align: center" > <h3 style="color: black">Réessayez!!!</h3></strong>
     </div>
        <?php
     }

     ?>
     
     

     <!-- Alert -->
    <form action="" method="POST">
        <div class="input-box">
            <input type="text"  name="username" placeholder="Entrez votre nom d'utilisateur" minlength="4" maxlength="14" required>
            <?php if(!empty($errorMessageUser)) { ?>
                <div class="errorsms" id="errorUser">
                    <p style="color: red"><?php echo $errorMessageUser; ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="input-box">
            <input type="email" name="email" placeholder="Email" required>
            <?php if(!empty($errorMessageEmail)) { ?>
                <div class="errorsms" id="errorEmail">
                    <p style="color: red"><?php echo $errorMessageEmail; ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Mot de passe" minlength="5" maxlength="14" required>
            <button type="button" name="showPassword" id="showPassword">&#128065;</button>
            <?php if(!empty($errorMessage)) { ?>
                <div class="errorsms" id="errorsms">
                    <p style="color: red"><?php echo $errorMessage; ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="input-box">
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer le Mot de passe" required>
            <?php if(!empty($errorMessage)) { ?>
                <div class="errorsms" id="errorsms2">
                    <p style="color: red"><?php echo $errorMessage; ?></p>
                </div>
            <?php } ?>
        </div>
        
        <div class="input-box">
            <label for="date">Date de naissance :</label><input type="date" name="date" placeholder="Date de naissance" required>
        </div><br>
        <div class="">
            <strong>Sexe :</strong>
            <input type="radio" id="femme" name="sexe" value="femme" required>
            <label for="femme">Féminin</label>
            <input type="radio" id="homme" name="sexe" value="homme" required>
            <label for="homme">Masculin</label> <br>
        </div>
            
        <br><label>
            <input type="checkbox" id="terme" name="terme" required>
            <strong>J'accepte les <a href="#">termes d'utilisation</a></strong>
        </label><br>
        <br><label>
            <input type="checkbox" id="terme" name="terme" required>
            <strong>J'accepte vos<a href="#"> politiques et confidentalités</a></strong>
        </label>
        <div class="input-box button">
            <input type="submit"  value="Envoyer">
        </div>
    </form>
</div>
       <script src="../js/register.js"></script>
       <script src="../js/showpassword.js"></script>
</body>
</html>
