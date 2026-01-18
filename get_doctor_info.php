<?php
include 'config.php';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT doctors.*, specializations.spec_name FROM doctors 
                           LEFT JOIN specializations ON doctors.spec_id = specializations.spec_id 
                           WHERE d_id = ?");
    $stmt->execute([$_GET['id']]);
    echo json_encode($stmt->fetch() ?: ['error' => 'not found']);
}
?>