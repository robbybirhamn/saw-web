<?php 
$level = getLevel();
?>
<div class="row">
    <div class="col-md-3">
        <label for="">Nomor Booking</label> <br>
        <?= $transaction['nopofk'] ?>
    </div>

    <div class="col-md-3">
        <label for="">Toko</label> <br>
        <?= $store['kode_store']." ".$store['name_store'] ?>
    </div>
    
    <div class="col-md-3">
        <label for="">Tanggal</label> <br>
        <?= $transaction['date_transaction'] ?>
    </div>

    <div class="col-md-3">
        <label for="">Keterangan</label> <br>
        <?= $transaction['link_transaction'] ?>
    </div>

    <?php if($transaction['file_transaction'] != ""){?>
    <div class="col-md-3">
        <label for="">Image</label> <br>
        <a href="<?= base_url('upload/marketplace/'.$transaction['file_transaction']) ?>"><button class="btn btn-primary">UNDUH</button></a>
    </div>
    <?php } ?>
</div>
<hr>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered" style="font-size:10px !important;">
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
            <tbody id="tbody-detail">
                <?php
                $grandtotal=0;
                $grandtotalqty=0;
                foreach ($transactiondetail as $trd) {
                                 $html = '<tr>
                            <td>
                            <input type="hidden" value="'.$trd['price_transdetail'].'" class="price" name="price_product[]">
                            <input type="hidden" value="'.$trd['id_product'].'" class="product" name="produk[]"> <span class="label_produk">'.$trd['code_product']."-".$trd['name_product'].'</span></td>';
                            $totqty = 0;
                            for ($i=27; $i <= 45 ; $i++) {
                                $qtyNya = $trd["qty_".$i."_transdetail"] ?? 0;
                                $html .= '<td><input type="hidden" name="qty_'.$i.'[]" style="width: 25px;" value="'.$qtyNya.'"> <span class="label_qty_'.$i.'">'.$qtyNya.'</span></td>';
                                $totqty += $qtyNya;
                            }
                    $html .= '
                            <td><input name="total_qty[]" type="hidden" style="width: 100px;" value="'.$totqty.'" readonly> <span class="label_total">'.$totqty.'</span></td>
                            <td><input name="total_transaction[]" type="hidden" style="width: 100px;" value="'.$trd['subtotal_transdetail'].'" readonly> <span class="label_total">'.$trd['subtotal_transdetail'].'</span></td>
                            <td><input name="discount[]" type="hidden" style="width: 100px;" value="'.$trd['discount_transdetail'].'" readonly> <span class="label_total">'.$trd['discount_transdetail'].'</span></td>
                            <td><input name="potongan[]" type="hidden" style="width: 100px;" value="'.$trd['potongan_transdetail'].'" readonly> <span class="label_total">'.$trd['potongan_transdetail'].'</span></td>
                            <td><input name="pajak[]" type="hidden" style="width: 100px;" value="'.$trd['tax_transdetail'].'" readonly> <span class="label_total">'.$trd['tax_transdetail'].'</span></td>
                            <td><input name="net[]" type="hidden" style="width: 100px;" value="'.$trd['net_transdetail'].'" readonly> <span class="label_total">'.$trd['net_transdetail'].'</span></td>
                        </tr>';
                    $grandtotal += $trd['subtotal_transdetail'];
                    $grandtotalqty += $totqty;

                    echo $html;
                }

                ?>
                <tr><td colspan ='20' align='right'>Grand Total = </td>
                    <td><?php echo $grandtotalqty; ?></td>
                    <td><?php echo $grandtotal; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <hr>
        <a href="<?= base_url('transaction'); ?>">
        <button class="btn btn-default">KEMBALI</button>
        </a>
    </div>
</div>