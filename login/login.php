<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../db.php');
    
    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT * FROM utilisateur WHERE (username = '$username' OR email = '$username')";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password']; // Récupère le mot de passe haché de la base de données

        if (password_verify($password, $hashedPassword)) {
            // Mot de passe correct
            // Redirection vers une page de succès ou autre
            header("Location: ../acceuil/acceuil.php");
            exit();
        } else {
            $errorMessage = "Mot de passe Incorrects!";
        }
    } else {
        $errorMessage = "Utilisateur ou Email incorrects ou n'existe pas!";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body class="body">
    <div class="container">
        <div class="img">
            <img src="../img/training.png" alt="">
        </div>

        <div class="login">
            <h2 class="title">Connexion</h2>
            <h1>Salut, user !</h1>
            <strong>Entrez vos identifiants personnels pour commencer votre aventure avec nous.</strong>
            
            <div class="identifiants">
                <form method="post" action="">
                    <input type="text" placeholder="Nom d'utilisateur/Email" name="username" required>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password"  placeholder="Mot de passe" required>
                        <button type="button" name="showPassword" id="showPassword">&#128065;</button><br>
                        <h3><a href="../modification/mdpOublier.php" ><strong >Mot de passe oublié ?</strong></a></h3> <!-- Add this line -->
                    </div><br>
                    <br><label>
                        <input type="checkbox" id="terms1" required>
                        <strong>J'accepte les <a href="#">termes d'utilisation</a></strong>
                    </label><br><br>
                    <input type="submit" id="submit" name="submit" value="Connexion">
                    <?php if(isset($errorMessage)) { ?>
                        <div class="errorsms" id="errorsms">
                            <h3><strong><?php echo $errorMessage; ?></strong></h3>
                        </div>
                    <?php } ?>
                </form>
                
            </div>
            <div class="link-2">
                <h3 >Vous n'avez pas de compte ? <a href="../register/register.php">
                    <strong>Créer un compte 
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm2 5.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12s5 1.755 5 1.755z"/></svg>
                    </strong> </h3>
            </div>
        </div>
          
    </div>
    
    <script>
    // Fonction pour masquer le message après 3 secondes
    function hideErrorMessage() {
        var errorMessage = document.getElementById("errorsms");
        errorMessage.style.display = "none";
    }

    // Appelle la fonction après 3 secondes (3000 millisecondes)
    setTimeout(hideErrorMessage, 3000);
    </script>
    <script src="../js/showpassword.js"></script>
</body>
</html>
