<?php
session_start();
$pageTitle = 'Tracking';
include './init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['your_order'])) {
  $orders_number = $_POST['orders_number'];
  $stmt = $con->prepare("SELECT `id`, `orders_number`, `customer_id`, `product_name`, `product_quantity`, `product_price`, `currency`, `subtotal`, `note_customer`, `order_date`, `order_status` FROM `orders` WHERE `orders_number` = ?");
  $stmt->execute([$orders_number]);
  $Orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="track-order">
  <div class="container">
    <?php if (isset($Orders)) : ?>
      <a class="btn btn-light my-2" href="./tracking.php"><i class="fa fa-backward" aria-hidden="true"></i>&nbsp;Back</a>
      <?php if (count($Orders) > 0) : ?>
        <h1><i class="fa-solid fa-boxes-packing"></i>&nbsp;Đơn hàng của bạn</h1>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Số đơn hàng</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Ngày</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($Orders as $order) : ?>
                <tr>
                  <td>
                    <?php echo $order['orders_number']; ?>
                  </td>
                  <td>
                    <?php echo $order['product_name']; ?>
                  </td>
                  <td>
                    <?php echo $order['product_quantity'] . ' (x' . $order['product_price'] . $order['currency'] . ')'; ?>
                  </td>
                  <td>
                    <?php echo $order['subtotal'] . '&nbsp;' . $order['currency']; ?>
                  </td>
                  <td>
                    <?php echo $order['order_date']; ?>
                  </td>
                  <td class="text-capitalize <?php $status = $order['order_status'];
                                              if ($status == 'pending') {
                                                echo 'text-bg-warning'; // Pending
                                              } elseif ($status == 'cancelled') {
                                                echo 'text-bg-danger'; // Cancelled
                                              } elseif ($status == 'processing') {
                                                echo 'text-bg-primary'; // Processing
                                              } elseif ($status == 'pending payment') {
                                                echo 'text-bg-info'; // Pending Payment
                                              } elseif ($status == 'completed') {
                                                echo 'text-bg-success'; // Completed
                                              } elseif ($status == 'failed') {
                                                echo 'text-bg-danger'; // Failed
                                              } ?>">
                    <?php echo $order['order_status']; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else : ?>
        <div class="alert alert-warning text-center mt-5" role="alert">
          Không tìm thấy đơn hàng với số đơn hàng đã cung cấp.
        </div>
        <script>
          setTimeout(function() {
            window.location.href = '<?php echo $_SERVER['HTTP_REFERER']; ?>';
          }, 6000);
        </script>
      <?php endif; ?>
    <?php else : ?>
      <h1>Theo dõi đơn hàng</h1>
      <form method="post" role="search" autocomplete="off" class="py-3 col-md-6 mx-auto">
        <div class="input-group mb-3">
          <input class="form-control" name="orders_number" placeholder="Số đơn hàng" aria-label="Số đơn hàng" required="required" />
          <button class="btn btn-dark" type="submit" name="your_order" disabled>Tìm kiếm</button>
        </div>
      </form>
    <?php endif; ?>
  </div>
</div>
<?php
include $tpl . 'footer.php'; ?>