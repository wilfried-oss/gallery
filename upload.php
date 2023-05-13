<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "openai";

// Création d'une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_FILES["image_produit"]) && isset($_POST["nom_produit"])) {
    $images_produits = $_FILES["image_produit"]["name"];
    $noms_produits = $_POST['nom_produit'];
    for ($i = 0; $i < count($_POST["nom_produit"]); $i++) {
        $nom_produit = $noms_produits[$i];
        $fileName = $images_produits[$i];
        $allowed = array('jpg', 'jpeg', 'png', 'gif', 'svg');

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        if (in_array($fileActualExt, $allowed)) {
            $fileNameNew = strtolower($nom_produit) . '.' . $fileActualExt;
            $fileDestination = 'uploads/' . $fileNameNew;
            // Enregistre le nom de l'image et le nom du produit dans une base de données
            $sql = "INSERT INTO produits (name, profile) VALUES ('$nom_produit', '$fileDestination')";
            $feedback = mysqli_query($conn, $sql);
            // Déplace l'image téléchargée dans le dossier "uploads"
            move_uploaded_file($_FILES['image_produit']['tmp_name'][$i], $fileDestination);
        } else {
            echo 'Vous ne pouvez pas télécharger ce type de fichier.';
        }
    }
}

$conn->close();
