<h3>Produk Favorit</h3>
<hr>
<form action="">
<div class="row">
    <div class="col-md-3">
        <label for="">Status Stok</label>
        <select name="filter_stock" id="filter_stock" class="form-control select2">
            <option value="">semua</option>
            <option value="1" <?= ($filter_stock == "1") ? "selected" : "" ?>>Stok 1</option>
            <option value="2" <?= ($filter_stock == "2") ? "selected" : "" ?>>Stok 2</option>
            <option value="3" <?= ($filter_stock == "3") ? "selected" : "" ?>>Stok 3</option>
            <option value="4" <?= ($filter_stock == "4") ? "selected" : "" ?>>Stok 4</option>
            <option value="5" <?= ($filter_stock == "5") ? "selected" : "" ?>>Stok 5</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="">&nbsp;</label><br>
        <button class="btn btn-primary">FILTER</button>
        <a href="<?= base_url('stock/export?filter_stock='.$filter_stock) ?>"><button class="btn btn-success" type="button">EXPORT</button></a>
    </div>
</div>
</form>
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
        <th>Total</th>
        <!-- <th>Updated At</th> -->
        <?php if(getLevel() == "admin"){?>
        <th>Pilihan</th>
        <?php } ?>
    </tr>
    </thead>

    <tbody>
    <?php 
    foreach ($data as $stok) { ?>
    <tr>
        <!-- <td><a href="<?= base_url('transaction_v2/create/'.$stok['id_product']) ?>"><button class='btn btn-sm btn-success'><i class='fa fa-shopping-cart'></i></button></a></td> -->
        <td><?= $stok['price_product'] ?></td>
        <td><?= $stok['GDGFG'] ?></td>
        <td><?php if($stok['img'] != "") {?><a href="<?= base_url('upload/product/'.$stok['img']) ?>" target="_blank">lihat gambar</a><?php } ?></td>
        <td><?php if($stok['img_2'] != "") {?><a href="<?= base_url('upload/product/'.$stok['img_2']) ?>" target="_blank">lihat gambar</a><?php } ?></td>
        <td><?= $stok['code_product'] ?></td>
        <td><?= $stok['name_product'] ?></td>
        <td><?= $stok['name_division'] ?></td>
        <td><?= $stok['totalstok'] ?></td>
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