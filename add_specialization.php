<?php
include 'config.php';

if (isset($_POST['add_spec'])) {
    $name = $_POST['spec_name'];
    
    $stmt = $pdo->prepare("INSERT INTO specializations (spec_name) VALUES (?)");
    try {
        $stmt->execute([$name]);
        echo "<script>alert('تم إضافة التخصص بنجاح');</script>";
    } catch (PDOException $e) {
        echo "خطأ: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة تخصص جديد</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; text-align: center; }
        .form-box { width: 350px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #27ae60; color: white; border: none; padding: 10px; width: 100%; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="form-box">
        <h2>إضافة تخصص طبي جديد</h2>
        <form method="POST">
            <input type="text" name="spec_name" placeholder="اسم التخصص (مثلاً: أطفال، قلب)" required>
            <button type="submit" name="add_spec">حفظ التخصص</button>
        </form>
    </div>
</body>
</html>