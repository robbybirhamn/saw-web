<div class="row">
    <div class="col-md-6">
        <h3>Rekap Stok Barang Kosong</h3>
    </div>
    <div class="col-md-6 text-right">
        <label for="">&nbsp;</label><br>
        <a href="<?= base_url('stock/export_empty') ?>"><button type="button" class="btn btn-success">EXPORT DATA</button></a>
    </div>
</div>
<hr>
<div class="table-responsive">
<table class="table table-bordered table-mini" width="100%" id="dataTable" cellspacing="0">
    <thead>
    <tr>
        <!-- <th>Cart</th>     -->
        <th>Harga</th>    
        <th>Gudang</th>
        <th>Image</th>
        <th>Image 2</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Collection</th>
        <?php for ($i=27; $i <= 45 ; $i++) {  ?>
            <th><?= $i ?></th>
        <?php } ?>
        <th>Total</th>
        <th>Last Date</th>
        <?php if(getLevel() == "admin"){?>
        <th>Pilihan</th>
        <?php } ?>
    </tr>
    </thead>

    <tbody>
    <?php 
    foreach ($data as $stok) { 
        if($stok['code_product'] == "")
        {
            continue;
        }
        ?>
    <tr>
        <!-- <td><a href="<?= base_url('transaction_v2/create/'.$stok['id_product']) ?>"><button class='btn btn-sm btn-success'><i class='fa fa-shopping-cart'></i></button></a></td> -->
        <td><?= $stok['price_product'] ?></td>
        <td><?= $stok['GDGFG'] ?></td>
        <td><?php if($stok['img'] != "") {?><a href="<?= base_url('upload/product/'.$stok['img']) ?>" target="_blank">lihat gambar</a><?php } ?></td>
        <td><?php if($stok['img_2'] != "") {?><a href="<?= base_url('upload/product/'.$stok['img_2']) ?>" target="_blank">lihat gambar</a><?php } ?></td>
        <td><?= $stok['code_product'] ?></td>
        <td><?= $stok['name_product'] ?></td>
        <td><?= $stok['name_division'] ?></td>
        <?php 
            $totalstok = 0;
            for ($i=27; $i <= 45 ; $i++) {  
                $totalstok += $stok["AK".$i."FG"];
            ?>
            <td <?= ($stok["AK".$i."FG"] == 0) ? "style='background:#53E09C;color:black;'" : "" ?>><?php if($stok["AK".$i."FG"] == 0){ echo $stok["AK".$i."FG"]; } else{ echo "";} ?></td>
        <?php } ?>
        <td><?= $stok['totalstok'] ?></td>
        <td><?= $stok['last_date'] ?></td>
        <!-- <td><?= $stok['updated_at'] ?></td> -->
        <?php if(getLevel() == "admin"){?>
        <td>
            <a href="<?= base_url('module/stok/read/'.$stok['id']) ?>">
                <button class="btn btn-sm btn-danger"><i class="fa fa-eye"></i></button>
            </a>
        </td>
        <?php } ?>
    </tr>
    <?php } ?>
    </tbody>
</table>
</div>

<script>
$(document).ready(function(){
    $('#accordionSidebar').addClass('toggled');
});
</script>