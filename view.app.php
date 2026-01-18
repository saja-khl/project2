<?php
include 'config.php';
$stmt = $pdo->query("SELECT a.*, d.d_name, d.d_image, s.spec_name FROM appointments a 
                     LEFT JOIN doctors d ON a.d_id = d.d_id 
                     LEFT JOIN specializations s ON d.spec_id = s.spec_id");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head><style> img { width:50px; height:50px; border-radius:50%; } table { width:100%; border-collapse:collapse; text-align:center; } th, td { border:1px solid #ddd; padding:8px; } </style></head>
<body>
<?php include 'header.php'; ?>
<table>
    <tr><th>صورة المريض</th><th>المريض</th><th>الطبيب</th><th>صورة الطبيب</th><th>التخصص</th></tr>
    <?php while($r = $stmt->fetch()): ?>
    <tr>
        <td><img src="uploads/patients/<?=$r['p_image']?>"></td>
        <td><?=$r['p_name']?></td>
        <td><?=$r['d_name']?></td>
        <td><img src="uploads/doctors/<?=$r['d_image']?>"></td>
        <td><?=$r['spec_name']?></td>
    </tr>
    <?php endwhile; ?>
</table>
</body></html>