<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['language'])) {
  $selectedLanguage = $_POST['language'];
  $_SESSION['language'] = $selectedLanguage;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;
}
if (isset($_SESSION['language'])) {
  $selectedLanguage = $_SESSION['language'];
} else {
  $browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
  $supportedLanguages = ['en', 'vi'];
  $selectedLanguage = in_array($browserLanguage, $supportedLanguages) ? $browserLanguage : 'en';
  $_SESSION['language'] = $selectedLanguage;
}
if ($selectedLanguage === 'vi') {
  include $lang . "vi.php";
} else {
  include $lang . "en.php";
}
?>
<!doctype html>
<html dir="<?php echo $lang['Ltr']; ?>" lang="<?php echo $lang['En']; ?>" data-bs-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php getTitle(); ?></title>
  <meta name="description" content="Khám phá một phạm vi rộng lớn của sản phẩm điện tử chất lượng cao tại cửa hàng trực tuyến của Said Lagauit. Mua sắm phần mềm, ứng dụng, trò chơi và nhiều hơn nữa. Thưởng thức các ưu đãi tuyệt vời, giao hàng nhanh chóng và dịch vụ khách hàng ngoạn mục. Bắt đầu trải nghiệm mua sắm điện tử ngay hôm nay!" />
  <link rel="shortcut icon" href="<?php echo $img ?>favicon_io/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo $css; ?><?php echo $lang['Bootstrap']; ?>" />
  <link rel="stylesheet" href="<?php echo $css ?>all.min.css" />
  <link rel="stylesheet" href="<?php echo $css ?>flag-icons.min.css" />
  <link rel="stylesheet" href="<?php echo $css ?>main.css" />

</head>

<body>