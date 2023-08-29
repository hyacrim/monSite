<?php
$error2 = "";


 // Assurez-vous que la connexion à la base de données est établie

 include('../db.php');
 $user = $_GET['email'];
 $q = "SELECT username FROM utilisateur WHERE email = '$user'";
 $username = ""; // Initialiser la variable pour stocker le nom d'utilisateur// Exécutez la requête pour obtenir le nom d'utilisateur
$result = $conn->query($q);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_GET['email'];
    $secret = $_POST['secret'];

    $query = "SELECT * FROM utilisateur WHERE email = '$email' AND secret = '$secret'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        $error2 = "Phrase de récupération incorrecte.";
    } else {
        $user = $result->fetch_assoc();
        $username = $user['email'];
        header("Location: pass.php?email=$email");
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
    <div class="content" id="content2">
        <h1 style="color: blue"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/></svg>
  <?php echo $username; ?></h1>
        <form method="post">
            <label for="secret">Entrez votre phrase ou mot secret</label>
            <input type="text" name="secret" placeholder="" class="input-field" ><br>
            <a href="mdpOublier.php"><button type="button" class="retour" > &#10094; Retour</button></a>
            <button type="submit" name="submit2" class="submit-button">Valider</button><br>
            <span style="color: red;"><?php echo $error2; ?></span>
        </form>
    </div>
</body>
</html>
