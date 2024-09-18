<?php

include "db.php";

$pdo = connect();

if (!$pdo) {
    echo "Error connecting to the database!";
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $fetchquery = $pdo->prepare('SELECT * FROM personne WHERE id = :id');
    $fetchquery->execute([':id' => $id]);
    $query = $fetchquery->fetch(PDO::FETCH_ASSOC);

    if (!$query) {
        echo "No record found";
        exit;
    }
} else {
    echo "No ID provided";
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    if (!empty($name) && !empty($email)) {
        $updatequery = $pdo->prepare("UPDATE personne SET name = :name, email = :email WHERE id = :id");
        $queryUP = $updatequery->execute([':name' => $name, ':email' => $email, ':id' => $id]);

        if ($queryUP) {
            header('Location: read.php');
            exit;
        } else {
            echo "Error updating the record";
        }
    } else {
        echo "Please fill in both name and email";
    }
}

?>

<form method="post">
    <h4>Edit Name</h4>
    <input type="text" name="name" value="<?php echo htmlspecialchars($query['name']); ?>"> 
    <h4>Edit Email</h4>
    <input type="text" name="email" value="<?php echo htmlspecialchars($query['email']); ?>">
    <button type="submit">Update</button>
</form>
