<?php
$error1 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../db.php');
    $email = $_POST['email'];
    $date = $_POST['datenaissance'];

    $query = "SELECT * FROM utilisateur WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        $error1 = "Email introuvable.";
    } else {
        $user = $result->fetch_assoc();
        $storedDate = $user['datenaissance'];

        if ($storedDate == $date) {
            header("Location: secret.php?email=$email");
            exit();
        } else {
            $error1 = "La date ne correspond pas à l'email choisi.";
        }
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
    <div class="content" id="content1">
        <h2>Authentification</h2>
        <form method="post">
            <input type="email" name="email" placeholder="Entrez votre email" class="input-field" required><br>
            <label for="date">Entrez votre date: <input type="date" name="datenaissance" placeholder="" class="input-field" required></label><br>
            <button type="submit" name="submit1" class="submit-button">Valider</button><br>
            <span style="color: red;"><?php echo $error1; ?></span>
        </form>
    </div>
</body>
</html>
