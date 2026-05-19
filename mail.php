<?php
// 文字化け防止の設定（さくらサーバー等の環境用）
mb_language("Japanese");
mb_internal_encoding("UTF-8");

// 1. 設定：受信したいメールアドレスを入力してください ★ここを書き換え
$to_email = "vchama24@coral.ocn.ne.jp"; 

// 2. フォームからのデータ取得
$name    = $_POST['name'] ?? '';
$kana    = $_POST['kana'] ?? '';
$email   = $_POST['email'] ?? '';
$tel     = $_POST['tel'] ?? '';
$item    = $_POST['item'] ?? '';
$message = $_POST['message'] ?? '';

// 3. 「送信」ボタンが押された場合（確認画面からの遷移）
if (isset($_POST['action']) && $_POST['action'] === 'submit') {
    $subject = "【ホームページ】お問い合わせがありました";
    $body = "ホームページよりお問い合わせがありました。\n\n";
    $body .= "【お名前】: $name ($kana)\n";
    $body .= "【メール】: $email\n";
    $body .= "【電話番号】: $tel\n";
    $body .= "【項目】: $item\n";
    $body .= "【内容】:\n$message\n";
    $headers = "From: info@morozumi.jp" . "\r\n"; // メールのヘッダー（送信元など）
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion(); // 念のため送信プログラム情報を付与


// 4. メール送信実行
if (mb_send_mail($to_email, $subject, $body, $headers)) {
    header("Location: thanks.html");
    exit;
    } else {
    $error = "送信に失敗しました。";
    }
}
?>

