<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Stok.xls");
?>
<table class="table table-bordered table-mini" width="100%" id="dataTable" cellspacing="0">
    <thead>
    <tr>
        <th>Harga</th>    
        <th>Gudang</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Collection</th>
        <?php for ($i=27; $i <= 45 ; $i++) {  ?>
            <th><?= $i ?></th>
        <?php } ?>
        <th>Total</th>
    </tr>
    </thead>

    <tbody>
    <?php 
    foreach ($data as $stok) { ?>
    <tr>
        <td><?= $stok['price_product'] ?></td>
        <td><?= $stok['GDGFG'] ?></td>
        <td><?= $stok['code_product'] ?></td>
        <td><?= $stok['name_product'] ?></td>
        <td><?= $stok['name_division'] ?></td>
        <?php 
            $totalstok = 0;
            for ($i=27; $i <= 45 ; $i++) {  
                $totalstok += $stok["AK".$i."FG"];
            ?>

            <?php if($this->uri->segment(2) == "export_empty"){ ?>
                <td <?= ($stok["AK".$i."FG"] == 0) ? "bgcolor='#53E09C'" : "" ?>><?php if($stok["AK".$i."FG"] ==0){ echo $stok["AK".$i."FG"]; } else{ echo "";} ?></td>
            <?php }else{ ?>
                <td <?= ($stok["AK".$i."FG"] < @end($filter_stock) AND $stok["AK".$i."FG"] != 0) ? "bgcolor='#53E09C'" : "" ?>><?php if($stok["AK".$i."FG"] < @end($filter_stock)){ echo $stok["AK".$i."FG"]; } else{ echo "";} ?></td>
            <?php } ?>
        <?php } ?>
        <td><?= $stok['totalstok'] ?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>