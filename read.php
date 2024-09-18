<?php

include "db.php";

$pdo = connect();

if(!$pdo){
    echo 'Failed connection'; 
    exit;
}

if($pdo){
    $query = $pdo->query('SELECT * FROM personne');
    
    $queryfetch = $query->fetchAll(PDO::FETCH_ASSOC);

    if($queryfetch){
        echo "<table border='2'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";

        foreach ($queryfetch as $op){
            echo "<tr>";
            echo "<td>" . $op['id'] . "</td>";
            echo "<td>" . $op['name'] . "</td>";
            echo "<td>" . $op['email'] . "</td>" ;
            echo "<td><a href='update.php?id=" . $op['id'] . "'>Edit</a></td>";
            echo "<td><a href='delete.php?id=" . $op['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }
} else {
    echo "Database connection failed";
}

?>

<form method="post">
    <button type="submit">Refresh</button>
    <a href="create.php">Insert</a>
</form>
