<?php
// ตั้งค่าผู้รับอีเมลของคุณ
$to = "xxxasd1421@gmail.com"; // <-- เปลี่ยนเป็นอีเมลจริงของคุณ
$subject = "New Contact Message from Portfolio Website";

// ตรวจสอบว่าแบบฟอร์มถูกส่งมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากแบบฟอร์ม
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject_input = strip_tags(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // ตรวจสอบความถูกต้อง
    if (empty($name) || empty($subject_input) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง</p>";
        exit;
    }

    // สร้างเนื้อหาอีเมล
    $email_content = "ชื่อ: $name\n";
    $email_content .= "อีเมล: $email\n\n";
    $email_content .= "หัวข้อ: $subject_input\n\n";
    $email_content .= "ข้อความ:\n$message\n";

    // สร้างหัวอีเมล
    $email_headers = "From: $name <$email>";

    // ส่งอีเมล
    if (mail($to, $subject, $email_content, $email_headers)) {
        echo "<p style='color:green;'>ข้อความของคุณถูกส่งเรียบร้อยแล้ว ขอบคุณที่ติดต่อเรา</p>";
    } else {
        echo "<p style='color:red;'>เกิดข้อผิดพลาดในการส่ง กรุณาลองใหม่อีกครั้ง</p>";
    }
} else {
    echo "<p style='color:red;'>ไม่สามารถส่งแบบฟอร์มได้</p>";
}
?>
