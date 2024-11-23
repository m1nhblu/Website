<?php
session_start();
$pageTitle = 'Liên Hệ';
include './init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["subject"]) && !empty($_POST["message"])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
    $stmt = $con->prepare("INSERT INTO `contacts`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)");
    $stmt->execute(array($name, $email, $subject, $message));
    if ($stmt->rowCount() > 0) {
      show_message('Tin nhắn của bạn đã được gửi và sẽ sớm được trả lời', 'success');
      header('location: contact.php');
      exit();
    } else {
      show_message('Đã xảy ra lỗi khi gửi tin nhắn. Vui lòng thử lại sau', 'danger');
    }
  } else {
    show_message('Vui lòng điền đầy đủ thông tin.', 'danger');
  }
}
?>
<div class="contact">
  <div class="container">
    <h1>Liên Hệ Với Chúng Tôi</h1>
    <?php
    if (isset($_SESSION['message'])) : ?>
      <div id="message">
        <?php echo $_SESSION['message']; ?>
      </div>
    <?php unset($_SESSION['message']);
    endif;
    ?>
    <div class="row g-3">
      <div class="col-md-6">
        <img src="<?php echo $img ?>contacts.webp" width="100%" class="img-contact" alt="Tin nhắn">
      </div>
      <div class="col-md-6">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" id="name" required="required" />
            <label for="name">Họ Tên *</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="email" required="required" />
            <label for="email">Địa Chỉ Email *</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="subject" id="subject" required="required" />
            <label for="subject">Tiêu Đề *</label>
          </div>
          <div class="form-floating mb-3">
            <textarea type="text" class="form-control" name="message" id="message" style="height: 9rem;" required="required"></textarea>
            <label for="message">Nội Dung *</label>
          </div>
          <div class="d-grid gap-2">
            <button name="send_msg" class="btn btn-dark" type="submit"><i class="fa fa-paper-plane"></i> Gửi Tin Nhắn</button>
          </div>
          <p class="m-0">* Tất cả các trường đều bắt buộc.</p>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include $tpl . 'footer.php'; ?>
