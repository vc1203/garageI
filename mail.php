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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>お問い合わせ | ガレージI</title>
<meta name="description" content="長野県岡谷市神明町にあるロードスター専門店ガレージIへのお問い合わせフォームです。">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>

<body>

<header>
  <nav class="nav-container">
    <h1><a href="#"><img src="img/garageI.webp" alt="GARAGE I"></a></h1>
    <button class="menu-trigger" aria-label="メニューを開く">
      <span></span><span></span><span></span>
    </button>
    <div class="nav-content">
      <ul class="nav-menu">
        <li><a href="#company">会社案内</a></li>
        <li><a href="#inventory">新・中古車販売</a></li>
        <li><a href="#custom">カスタム</a></li>
        <li><a href="#contact">お問い合わせ</a></li>
      </ul>
      <ul class="nav-sns-list">
        <li>
          <a href="https://www.youtube.com/@garagei7617" target="_blank" rel="noopener noreferrer" class="youtube-link" aria-label="YouTube">
            <i class="fa-brands fa-youtube"></i>
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/garagei_komaba.isamu/" target="_blank" rel="noopener noreferrer" class="insta-link" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>


<main style="padding-top: 40px;">
  <section class="form-page-section">
    <div class="form-header">
      <h2>CONTACT</h2>
      <p>お問い合わせ</p>
      <span class="form-desc-text">車両在庫のご確認、カスタム・メンテナンスのご相談など、お気軽にお問い合わせください。</span>
    </div>
    
    <div class="contact-card-wrap">
      <form action="mail.php" method="POST" onsubmit="return confirm('この内容で送信してもよろしいですか？')">
        <div class="contact-form-grid">
          
          <div class="form-group-half">
            <label class="form-label">お名前 <span class="badge-required">必須</span></label>
            <input type="text" name="name" class="form-control" placeholder="例：岡谷 太郎" required>
          </div>
  
          <div class="form-group-half">
            <label class="form-label">フリガナ <span class="badge-required">必須</span></label>
            <input type="text" name="kana" class="form-control" placeholder="例：オカヤ タロウ" required>
          </div>
  
          <div class="form-group-full">
            <label class="form-label">メールアドレス <span class="badge-required">必須</span></label>
            <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
          </div>
  
          <div class="form-group-full">
            <label class="form-label">電話番号 <span class="badge-optional">任意</span></label>
            <input type="tel" name="tel" class="form-control" placeholder="000-0000-0000">
          </div>
  
          <div class="form-group-full">
            <label class="form-label">お問い合わせ項目 <span class="badge-required">必須</span></label>
            <select name="item" class="form-select" required>
              <option value="" selected disabled>項目を選択してください</option>
              <option value="中古車在庫・購入について">中古車在庫・購入について</option>
              <option value="カスタム・チューニング相談">カスタム・チューニング相談</option>
              <option value="車検・整備・メンテナンス">車検・整備・メンテナンス</option>
              <option value="その他">その他</option>
            </select>
          </div>
  
          <div class="form-group-full">
            <label class="form-label">お問い合わせ内容 <span class="badge-required">必須</span></label>
            <textarea name="message" class="form-control" rows="6" placeholder="ご相談内容をご記入ください。" required></textarea>
          </div>
  
          <div class="form-submit-wrap">
            <button type="submit" name="action" value="submit" class="contact-submit-btn">入力内容を確認して送信する</button>
          </div>
          
        </div>
      </form>
    </div>
  </section>
</main>

<footer>
  <div class="footer-container">
    <div class="footer-left">
      <img src="img/garageI.webp" alt="GARAGE I">
      <p class="copyright pc-only">© 2026 GARAGE I. All Rights Reserved.</p>
    </div>
    <div class="footer-right">
      <div class="footer-item"><span class="icon"><i class="fa-solid fa-location-dot"></i></span><span>394-0004 長野県岡谷市神明町2丁目1-28</span></div>
      <div class="footer-item"><span class="icon"><i class="fa-solid fa-phone"></i></span><span>0266-24-5086（10:00〜17:00）</span></div>
      <div class="footer-item"><span class="icon"><i class="fa-solid fa-envelope"></i></span><span>yajapa@yahoo.co.jp</span></div>
    </div>
    <p class="copyright sp-only">© 2026 GARAGE I. All Rights Reserved.</p>
  </div>
</footer>

<script src="script.js"></script>
</body>
</html>