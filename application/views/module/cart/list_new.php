<div class="row">
    <div class="col-md-12">
    <form action="<?= base_url('checkout') ?>" method="POST">
        <?php 
        $carts = $this->Cart_model->data();
        foreach ($carts as $x) { ?>
            <input type="hidden" name="cart[]" value="<?= $x['id'] ?>">
        <?php } ?>
        <table class="table table-bordered" style="font-size:10px !important;" id="table-los">
            <thead>
                <tr>
                    <th>Produk</th>
                    <?php for ($i=27; $i <= 45 ; $i++) { ?>
                        <th><?= $i ?></th>
                    <?php } ?>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Diskon</th>
                    <th>Potongan</th>
                    <th>Pajak</th>
                    <th>Net</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $data = $this->Cart_model->data_new();
                $totalx = 0; $totalQty = 0;
                foreach ($data as $dt) { ?>
                    <tr>
                        <td><?= $dt['code_product']." - ".$dt['name_product'] ?></td>
                        <?php 
                        $jml_qty = 0;
                        for ($i=27; $i <= 45 ; $i++) { 
                            $jml_qty += $dt[$i];
                            ?>
                            <td><?= $dt[$i] ?></td>
                        <?php } ?>
                        <td><?= $jml_qty ?></td>
                        <td><?= number_format($dt['total'],0,0,".") ?></td>
                        <td><?= number_format($dt['total']*$dt['diskon']/100,0,0,".") ?></td>
                        <td><?= number_format($dt['potongan'],0,0,".") ?></td>
                        <td><?= number_format($dt['pajak'],0,0,".") ?></td>
                        <td><?= number_format($dt['net'],0,0,".") ?></td>
                    </tr>
                <?php
                $totalx += $dt['net'];
                $totalQty += $jml_qty;
                } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td align="right" colspan="25">
                        <b>Total</b>
                    </td>
                    <td><?= number_format($totalx,0,0,".") ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="25">
                        <b>Total Qty</b>
                    </td>
                    <td><?= number_format($totalQty,0,0,".") ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <a href="<?= base_url('cart/destroy') ?>"><button type="button" class="btn btn-danger">KOSONGKAN KERANJANG</button></a>
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