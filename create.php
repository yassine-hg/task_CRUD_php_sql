<?php

include "db.php";

$pdo = connect();

if ($pdo) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];

        if (!empty($name) && !empty($email)) {
            $inserting = $pdo->prepare("INSERT INTO personne (name, email) VALUES (:name, :email)");

            if ($inserting->execute([':name' => $name, ':email' => $email])) {
                header("Location: read.php");
                echo "Record successfully added";
            } else {
                echo "Error: ";
            }
        } else {
            echo "Fill the blanks";
        }
    }
} else {
    echo "Database failed";
}
?>

<form action="read.php" method="post">
    <h4>Enter your name</h4>
    <input type="text" name="name">
    <h4>Enter your email</h4>
    <input type="text" name="email">
    <button type="submit">Submit</button>
</form>
