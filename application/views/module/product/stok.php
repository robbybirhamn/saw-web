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
    <div class="col-md-3 text-right">
        <label for="">&nbsp;</label><br>
        <?php
        if($this->uri->segment(2) == "favorite")
        {
            ?><a href="<?= base_url('product') ?>"><button type="button" class="btn btn-primary">SEMUA PRODUK</button></a><?php
        }else{
            ?><a href="<?= base_url('product/favorite') ?>"><button type="button" class="btn btn-warning"><i class="fa fa-star"></i> PRODUK FAVORIT</button></a><?php
        }
        ?>
    </div>
</div>
</form>
<hr>
<div class="table-responsive">
<table class="table table-bordered table-mini" width="100%" id="dataTable" cellspacing="0">
    <thead>
    <tr style="background:#4D73DF;color:white">
        <th width="100px">Cart</th>    
        <th>Harga</th>    
        <!-- <th>Gudang</th> -->
        <th>Image</th>
        <th>Image 2</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Collection</th>
        <?php for ($i=27; $i <= 45 ; $i++) {  ?>
            <th><?php
            if($i=="28"){
              $z="28/S";
            }
            elseif($i=="29"){
              $z="29/M";
            }
            elseif($i=="30"){
              $z="30/L";
            }
            elseif($i=="31"){
              $z="31/XL";
            }
            elseif($i=="33"){
              $z="33/F";
            }
            else{
              $z=$i;
            }
             echo $z; ?></th>
        <?php } ?>        <th>Total</th>
        <!-- <th>Updated At</th> -->
        <?php if(getLevel() == "admin"){?>
        <th>Pilihan</th>
        <?php } ?>
    </tr>
    </thead>

    <tbody>
    <?php 
    $no = 1;
    $totalall = 0;
    foreach ($data as $stok) { 
        $no += 1;
        //favorite check
        $id = $stok['id_product'];
        $userlogin = get_id_login();
        $cekFavorite = $this->db->query("SELECT count(product_favorite) as total from tb_product_favorite WHERE product_favorite = '$id' AND user_favorite='$userlogin'")->row_array();
        ?>
    <tr <?= ($cekFavorite['total'] > 0) ? "bgcolor='#F4EE86'" : "" ; ?>>
        <td>
            <a href="<?= base_url('transaction_v2/create/'.$stok['id_product']) ?>"><button class='btn btn-sm btn-success'><i class='fa fa-shopping-cart'></i></button></a>
            <?php
            if($cekFavorite['total'] > 0)
            {
                ?><a href="<?= base_url('favorite/remove/'.$stok['id_product']) ?>"><button class='btn btn-sm btn-danger'><i class='fa fa-star'></i></button></a><?php
            }else{ ?>
                <a href="<?= base_url('favorite/add/'.$stok['id_product']) ?>"><button class='btn btn-sm btn-warning'><i class='fa fa-star'></i></button></a>
            <?php } ?>
        </td>
        <td><?= $stok['price_product'] ?></td>
        <td><?php if($stok['img'] != "") {?><a href="<?= base_url('upload/product/'.$stok['img']) ?>" target="_blank">lihat gambar</a><?php } ?></td>
        <td><?php if($stok['img_2'] != "") {?><a href="<?= base_url('upload/product/'.$stok['img_2']) ?>" target="_blank">lihat gambar</a><?php } ?></td>
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
        <?php 
        $totalall += $totalstok;
        } ?>
    </tr>
    <?php } ?>
    </tbody>
</table>
<p>Terdapat <?= number_format($totalall,0,0,".") ?> pcs dari <?= $no ?> barang</p>
</div>

<script>
$(document).ready(function(){
    $('#accordionSidebar').addClass('toggled');
});
</script>