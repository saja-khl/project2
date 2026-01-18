<?php 
include 'config.php';

$docs_query = $pdo->query("SELECT d_id, d_name FROM doctors");
$docs = $docs_query->fetchAll();

if(isset($_POST['save'])){
    $img_name = time() . "_" . $_FILES['p_img']['name'];
    $target_path = "uploads/patients/" . $img_name;
    
    if(move_uploaded_file($_FILES['p_img']['tmp_name'], $target_path)){
                $sql = "INSERT INTO appointments (p_name, age, phone, gender, d_id, medical_history, notes, p_image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute([
                $_POST['p_name'], 
                $_POST['age'], 
                $_POST['phone'], 
                $_POST['gender'], 
                $_POST['d_id'], 
                $_POST['history'], 
                $_POST['notes'], 
                $img_name
            ]);
            echo "<script>alert('تم تسجيل الموعد بنجاح'); window.location='view.app.php';</script>";
        } catch (PDOException $e) {
            echo "خطأ في الإدخال: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('فشل رفع الصورة، تأكد من وجود مجلد uploads/patients');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حجز موعد</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; text-align: center; }
        .form-container { width: 450px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, select, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { background: #1b5533ff; color: white; padding: 10px; border: none; width: 100%; border-radius: 5px; cursor: pointer; font-size: 16px; }
        #doctor-details { margin-top: 15px; padding: 15px; background: #f9f9f9; border: 1px dashed #27ae60; display: none; text-align: center; border-radius: 8px; }
        .doc-preview-img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #27ae60; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="form-container">
        <h2>تسجيل موعد مريض جديد</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="p_name" placeholder="اسم المريض" required>
            <input type="number" name="age" placeholder="العمر" required>
            <input type="text" name="phone" placeholder="رقم الهاتف" required>
            <select name="gender"><option value="ذكر">ذكر</option><option value="أنثى">أنثى</option></select>
            <select name="d_id" required onchange="showDoctorInfo(this.value)">
                <option value="">-- اختر الطبيب --</option>
                <?php foreach($docs as $d): ?>
                    <option value="<?=$d['d_id']?>"><?=$d['d_name']?></option>
                <?php endforeach; ?>
            </select>
            <div id="doctor-details">
                <img id="doc-img" src="" class="doc-preview-img"><br>
                <strong id="doc-name"></strong><br>
                <small id="doc-spec"></small><br>
                <p id="doc-desc" style="font-size: 12px;"></p>
            </div>
            <textarea name="history" placeholder="التاريخ الطبي"></textarea>
            <textarea name="notes" placeholder="الشكوى الحالية"></textarea>
            <input type="file" name="p_img" accept="image/*" required>
            <button type="submit" name="save">تأكيد الحجز</button>
        </form>
    </div>

    <script>
    function showDoctorInfo(doctorID) {
        const detailsBox = document.getElementById('doctor-details');
        if (!doctorID) { detailsBox.style.display = 'none'; return; }
        fetch('get_doctor_info.php?id=' + doctorID)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    document.getElementById('doc-img').src = 'uploads/doctors/' + (data.d_image || 'default.png');
                    document.getElementById('doc-name').innerText = 'د. ' + data.d_name;
                    document.getElementById('doc-spec').innerText = 'التخصص: ' + (data.spec_name || 'عام');
                    document.getElementById('doc-desc').innerText = data.d_description || '';
                    detailsBox.style.display = 'block';
                }
            });
    }
    </script>
</body>
</html>