
<style>
.table-mini
{
    font-size: 11px !important;
}
</style>
<h3>Daftar Stok Barang</h3>
<hr>
<form action="">
<div class="row">
    <div class="col-md-3">
        <label for="">Collection</label>
        <select name="collection_filter" id="collection_filter" class="form-control select2">
            <option value="">semua</option>
            <?php foreach ($divisions as $division) { ?>
            <option value="<?= $division['code_division'] ?>" <?= ($collectionFilter == $division['code_division']) ? "selected" : "" ?>><?= $division['name_division'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="">Class</label>
        <select name="class_filter" id="class_filter" class="form-control select2">
            <option value="">semua</option>
            <option value="N" <?= ($classFilter == "N") ? "selected" : "" ?>>Normal</option>
            <option value="D" <?= ($classFilter == "D") ? "selected" : "" ?>>Downgrade</option>
            <option value="C" <?= ($classFilter == "C") ? "selected" : "" ?>>Clearance</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="">&nbsp;</label><br>
        <button class="btn btn-primary">FILTER</button>
    </div>
</div>
</form>
<hr>
<div class="table-responsive">
<table class="table table-bordered table-mini" width="100%" id="dataTable" cellspacing="0">
    <thead>
    <tr>
        <th>Cart</th>    
        <th>Harga</th>    
        <!-- <th>Gudang</th> -->
        <th>Image</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Collection</th>
        <?php for ($i=27; $i <= 45 ; $i++) {  ?>
            <th><?= $i ?></th>
        <?php } ?>
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
        <td><a href="<?= base_url('cart/add/'.$stok['id_product']) ?>"><button class='btn btn-sm btn-success'><i class='fa fa-shopping-cart'></i></button></a></td>
        <td><?= $stok['price_product'] ?></td>
        <td><?php if($stok['img'] != "") {?><a href="<?= $stok['img'] ?>" target="blank">lihat gambar</a><?php } ?></td>
        <!-- <td><?= $stok['GDGFG'] ?></td> -->
        <td><?= $stok['code_product'] ?></td>
        <td><?= $stok['name_product'] ?></td>
        <td><?= $stok['name_division'] ?></td>
        <?php 
            $totalstok = 0;
            for ($i=27; $i <= 45 ; $i++) {  
                $totalstok += $stok["AK".$i."FG"];
            ?>
            <td><?= $stok["AK".$i."FG"] ?></td>
        <?php } ?>
        <td><?= $totalstok ?></td>
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