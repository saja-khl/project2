<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$auth = ["admin" => "123456"];
if (
    !isset($_SERVER['PHP_AUTH_USER']) ||
    !isset($auth[$_SERVER['PHP_AUTH_USER']]) ||
    $auth[$_SERVER['PHP_AUTH_USER']] !== $_SERVER['PHP_AUTH_PW']
) {
    header('WWW-Authenticate: Basic realm="Admin Login"');
    header('HTTP/1.0 401 Unauthorized');
    exit('غير مصرح بالدخول');
}

include 'config.php';

$specs = $pdo->query("SELECT * FROM specializations")->fetchAll();

if (isset($_POST['add'])) {

    $imgName = null;
    if (!empty($_FILES['d_img']['name'])) {
        $imgName = time() . "_" . $_FILES['d_img']['name'];
        move_uploaded_file(
            $_FILES['d_img']['tmp_name'],
            "uploads/doctors/" . $imgName
        );
    }

    $stmt = $pdo->prepare("
        INSERT INTO doctors 
        (d_name, spec_id, phone, d_image, d_description)
        VALUES (?,?,?,?,?)
    ");

    $stmt->execute([
        $_POST['name'],
        $_POST['spec'],
        $_POST['phone'],
        $imgName,
        $_POST['desc']
    ]);

    $success = true;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl" >
<head>
    <meta charset="UTF-8">
    <title>إضافة طبيب</title>
    <style>
        body{
            font-family: Tahoma;
            background:#f5f6fa;
            padding:40px;
        }
        .box{
            background:#fff;
            padding:25px;
            width:400px;
            margin:auto;
            border-radius:8px;
            box-shadow:0 0 10px #ccc;
        }
        input,select,textarea,button{
            width:100%;
            padding:8px;
            margin-top:10px;
        }
        button{
            background:#4CAF50;
            color:#fff;
            border:none;
            cursor:pointer;
        }
        .success{
            background:#dff9fb;
            color:#130f40;
            padding:10px;
            margin-bottom:10px;
            text-align:center;
        }
    </style>
</head>

<body>

<div class="box">
    <h3>إضافة طبيب جديد</h3>

    <?php if (!empty($success)): ?>
        <div class="success">تمت إضافة الطبيب بنجاح ✅</div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">

        <label>اسم الطبيب</label>
        <input type="text" name="name" required>

        <label>التخصص</label>
        <select name="spec" required>
            <option value="">اختر التخصص</option>
            <?php foreach ($specs as $s): ?>
                <option value="<?= $s['spec_id'] ?>">
                    <?= $s['spec_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>رقم الهاتف</label>
        <input type="text" name="phone">

        <label>صورة الطبيب</label>
        <input type="file" name="d_img">

        <label>الوصف</label>
        <textarea name="desc"></textarea>

        <button type="submit" name="add">إضافة الطبيب</button>
    </form>
</div>

</body>
</html>