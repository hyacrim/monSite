<?php
$error3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../db.php');
    $email = $_GET['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password != $cpassword) {
        $error3 = "Les mots de passe ne correspondent pas";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE utilisateur SET password = '$hashedPassword' WHERE email = '$email'";
        $conn->query($query);
        header("Location: succes.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page PHP</title>
    <link rel="stylesheet" href="../css/mdpo.css">
</head>
<body>
    <div class="content" id="content3">
        <h2 >Dernière Étape !</h2>
        <form method="post" id="passwordForm">
            <input type="password" name="password" placeholder="Entrez votre nouveau mot de passe" minlength="5" class="input-field" required>
            <input type="password" name="cpassword" placeholder="Entrez votre nouveau mot de passe" minlength="5" class="input-field" required>
            <br>
            <a href="mdpOublier.php"><button type="button" class="retour" > &#10094; Retour</button></a>
            <button type="submit" name="submit3" class="submit-button">Valider</button><br><br>
            <strong id="error" style="background-color: rgba(85, 53, 231, 0.5)"></strong>
        </form>
    </div>

    <script>
        // Fonction pour afficher le message d'erreur pendant 5 secondes
        function showError(message) {
            var errorElement = document.getElementById('error');
            errorElement.textContent = message;
            setTimeout(function() {
                errorElement.textContent = '';
            }, 5000); // 5000 millisecondes = 5 secondes
        }

        // Ajoutez cet événement pour afficher le message d'erreur lorsque le formulaire est soumis
        document.getElementById('passwordForm').addEventListener('submit', function(event) {
            var password = document.getElementsByName('password')[0].value;
            var cpassword = document.getElementsByName('cpassword')[0].value;

            if (password !== cpassword) {
                event.preventDefault(); // Empêche la soumission du formulaire
                showError("Les mots de passe ne correspondent pas!");
            }
        });
    </script>
</body>
</html>
