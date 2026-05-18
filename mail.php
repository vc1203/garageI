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

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>お問い合わせ | 株式会社 両角佛壇</title>
<meta name="Description" content="両角仏壇お問い合わせフォームです。仏壇・墓石・葬儀のことなど、なんでもお気軽にご相談ください。">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300;500;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/contact.css">
</head>

<body>

<div id="header"></div>

<main class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="contact-card">
        <div class="contact-header text-center mb-5">
          <h2 class="fw-bold">お問い合わせ</h2>
          <p class="text-secondary mt-3">仏壇・墓石のご相談、お見積りなど<br class="d-sm-none">お気軽にお問い合わせください。</p>
        </div>
    
        <form action="mail.php" method="POST" onsubmit="return confirm('この内容で送信してもよろしいですか？')">
          <div class="row g-4"> <div class="col-md-6">
              <label class="form-label fw-bold">お名前 <span class="badge bg-danger ms-2">必須</span></label>
              <input type="text" name="name" class="form-control custom-input" placeholder="例：両角 太郎" required>
            </div>
    
            <div class="col-md-6">
              <label class="form-label fw-bold">フリガナ <span class="badge bg-danger ms-2">必須</span></label>
              <input type="text" name="kana" class="form-control custom-input" placeholder="例：モロズミ タロウ" required>
            </div>

            <div class="col-12">
              <label class="form-label fw-bold">メールアドレス <span class="badge bg-danger ms-2">必須</span></label>
              <input type="email" name="email" class="form-control custom-input" placeholder="example@mail.com" required>
            </div>

            <div class="col-12">
              <label class="form-label fw-bold">電話番号 <span class="badge bg-secondary ms-2">任意</span></label>
              <input type="tel" name="tel" class="form-control custom-input" placeholder="000-0000-0000">
            </div>

            <div class="col-12">
              <label class="form-label fw-bold">お問い合わせ項目 <span class="badge bg-danger ms-2">必須</span></label>
              <select name="item" class="form-select custom-input" required>
                <option value="" selected disabled>項目を選択してください</option>
                <option value="終活相談">終活相談</option>
                <option value="仏壇・仏具について">仏壇・仏具について</option>
                <option value="墓石について">墓石について</option>
                <option value="位牌について">墓石について</option>
                <option value="葬儀について">葬儀について</option>
                <option value="その他">その他</option>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label fw-bold">お問い合わせ内容 <span class="badge bg-danger ms-2">必須</span></label>
              <textarea name="message" class="form-control custom-input" rows="6" placeholder="ご相談内容をご記入ください。" required></textarea>
            </div>

            <div class="col-12 text-center mt-5">
              <button type="submit" name="action" value="submit" class="contact-submit-btn">入力内容を確認して送信する</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<div id="footer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>