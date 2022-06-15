<br>
<h3>Seluruh Keranjang Belanja</h3>
<form action="<?= base_url('checkout') ?>" method="POST">
<table class="table table-bordered" width="100%" cellspacing="0" id="table-lois">
    <thead>
    <tr>
        <th><input type="checkbox" onClick="toggle(this)" checked/><br/></th>
        <th>Toko</th>    
        <th>User</th>    
        <th>Qty</th>    
        <th>Size</th>    
        <th>Nama Produk</th>
        <th>Harga Label</th>
        <th>Potongan</th>
        <th>Disc</th>
        <th>Harga</th>
        <th>Subtotal</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
    <?php 
    $totalCart = 0; $totalQty = 0;
    $carts = $this->Cart_model->getAll();
    foreach ($carts as $cart) {
        $totalCart += $cart['subtotalx'];
        $totalQty += $cart['qty'];
        ?>
    <tr>
        <td><input type="checkbox" name="cart[]" value="<?= $cart['id'] ?>" class="cart" checked></td>
        <td><?= $cart['store_product'] ?></td>
        <td><?= $cart['user_cart'] ?></td>
        <td><?= $cart['qty'] ?></td>
        <td><?= $cart['size_label'] ?></td>
        <td><?= $cart['name']." (".$cart['code_product'].")" ?></td>
        <td><?= rupiah_format($cart['price']) ?></td>
        <td><?= $cart['potongan'] ?></td>
        <td><?= $cart['diskon'] ?></td>
        <td><?= rupiah_format(($cart['price']-$cart['potongan'])-($cart['price']-$cart['potongan'])*$cart['diskon']/100) ?></td>
        <td><?= rupiah_format($cart['subtotalx']) ?></td>
        <td>
            <a href="<?= base_url('cart/remove/'.$cart['id']) ?>" onclick="return confirm('Hapus dari keranjang?')">
                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
            </a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><?= $totalQty ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Total</td>
        <td><?= rupiah_format($totalCart); ?></td>
    </tr>
    </tfoot>
</table>

<div class="row">
    <div class="col-md-6">
        <a href="<?= base_url('cart/destroy_all') ?>"><button type="button" class="btn btn-danger">KOSONGKAN KERANJANG</button></a>
        <a href="<?= base_url('product') ?>"><button type="button" class="btn btn-default">LANJUTKAN BELANJA</button></a>
    </div>
    <div class="col-md-6 text-right">
        <button type="submit" class="btn btn-primary">CHECKOUT</button>
    </div>
</div>
</form>

<script>
function toggle(source) {
  checkboxes = document.getElementsByClassName('cart');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

<script>
    $(document).ready(function() {
        $('#table-lois').DataTable( {
            "paging":   false,
            "ordering": true,
            "info":     false
        } );
    } );
</script>