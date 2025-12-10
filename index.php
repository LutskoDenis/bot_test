<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bot</title>
</head>
<body>
<?php
// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    
    // Ваши данные для Telegram
    $token = "8182946335:AAFHE2nSWzQhJeMhOFtmuKvQr-uXlJob3H0";
    $chat_id = "-1003374681218";
    
    $arr = array(
        'Имя пользователя: ' => $name,
        'Телефон: ' => $phone,
        'Email' => $email
    );

    $txt = "";
    foreach($arr as $key => $value) {
        $txt .= "<b>".$key."</b> ".$value."%0A";
    };

    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

    if ($sendToTelegram) {
        // Перенаправляем на страницу успеха
        header('Location: success.html');
        exit();
    } else {
        $error_message = "Произошла ошибка при отправке формы";
    }
}
?>

<div class="hc-right">
    <div class="form-block">
        <div class="form-title">Акция для новых клиентов</div>
        <div class="form-text">Получите скидку 15% и бесплатную диагностику Вашего компьютера</div>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message" style="color: red; margin-bottom: 15px;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <form action="" method="post">
            <input type="text" name="name" placeholder="Как вас зовут?" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            <input type="tel" name="phone" placeholder="Оставьте свой номер" required value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
            <input type="text" name="email" placeholder="Ваш E-mail" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <button type="submit" class="send-button">Получить скидку</button>
        </form>
    </div>
</div>

</body>
</html>