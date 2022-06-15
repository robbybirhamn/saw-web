
<form action="<?= base_url('checkout/store') ?>" method="POST" enctype="multipart/form-data"> 
<h3>Checkout</h3>

<?php
$carts = $this->input->post('cart');

if(empty($carts))
{
    ?>
    <div class="alert alert-warning"><i class="fa fa-info-circle"></i>  ANDA BELUM MEMILIH ITEM KERANJANG!</div>
    <a href="<?= base_url('cart') ?>"><button type="button" class="btn btn-default">KEMBALI</button></a>
    <?php
}else{ 
    ?>
<table class="table table-bordered">
    <tr>
        <th width="200px">Kode Toko</th>
        <td><?= $this->session->store_id ?> </td>

        <th width="200px">Tanggal Transaksi</th>
        <td>
            <input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>">
        </td>
    </tr>
    <tr>
        <th width="200px">Keterangan</th>
        <td>
            <input type="link" name="link" id="link" class="form-control">
        </td>
        
        <th width="200px">File Upload</th>
        <td><input type="file" name="file" id="file" class="form-control"></td>

    </tr>
</table>


<table class="table table-bordered" id="table-lois" width="100%" cellspacing="0">
    <thead>

    <tr>
        <th>Qty</th>    
        <th>Size</th>    
        <th>Nama Produk</th>
        <th>Harga Label</th>
        <th>Potongan</th>
        <th>Disc</th>
        <th>Harga</th>
        <th>Pajak</th>
        <th>Subtotal</th>
    </tr>
    </thead>

    <tbody>
    <?php 
    
    $grandtotal=0; $store = array(); $totalQty = 0;
    foreach ($carts as $idcart) { 
        $cart = $this->Cart_model->getDataById($idcart);

        @$store[$cart['store_product']] += 1;

        //potongan
        $tt = $cart['price']-$cart['potongan'];
        $ttp = $tt*$cart['qty'];
        $ttd = $ttp*$cart['diskon']/100;
        $total = $ttp-$ttd;
        // $total = $total + $cart['pajak']; //UPDATE ROBBY

        $totalQty += $cart['qty'];
        
        ?>
    <tr>
        <td>
        <input type="hidden" name="cart[]" value="<?= $idcart ?>">
        <?= $cart['qty'] ?></td>
        <td><?= $cart['size_label'] ?></td>
        <td><?= $cart['name']." (".$cart['code_product'].")" ?></td>
        <td><?= rupiah_format($cart['price']) ?></td>
        <td><?= $cart['potongan'] ?></td>
        <td><?= $cart['diskon'] ?></td>
        <td><?= rupiah_format($total/$cart['qty']) ?></td>
        <td><?= rupiah_format($cart['pajak']) ?></td>
        <td><?= rupiah_format($total) ?></td>
    </tr>
    <?php
    $grandtotal += $total;
    } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8" align="right">Grand Total</td>
            <td><?php echo rupiah_format($grandtotal); ?></td>
        </tr>
        <tr>
            <td colspan="8" align="right">Total Qty</td>
            <td><?php echo rupiah_format($totalQty); ?></td>
        </tr>
    </tfoot>
</table>


<div class="row">
    <div class="col-md-12 text-center">
        <?= (count($store) > 1 ? "<div class='alert alert-warning'>pastikan anda memilih pada toko yang sama!</div>" : "" ) ?>
        <a href="<?= base_url('cart') ?>"><button type="button" class="btn btn-default">KEMBALI</button></a>
        <button type="submit" class="btn btn-primary" <?= (count($store) > 1 ? "disabled" : "" ) ?> onclick="return confirm('Apakah anda yakin untuk checkout keranjang ini?')">CHECKOUT</button>
    </div>
</div>
<?php } ?>
</form>

<script>
    $(document).ready(function() {
        $('#table-lois').DataTable( {
            "paging":   false,
            "ordering": false,
            "info":     false
        } );
    } );
</script>