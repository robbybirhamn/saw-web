<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Transaksi.xls");
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>No</th>    
        <!-- <th>Faktur Web</th>   -->
        <th>Booking</th>  
        <th>Tanggal</th>    
        <th>Toko</th>
        <th>Gudang</th>
        <th>Total QTY</th>
        <th>Total</th>
        <th>Status</th>
    </tr>
    </thead>

    <tbody>
        <?php 
        $no = 1;
        foreach ($transcation as $dt) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <!-- <td><?= $dt['nofk_transaction'] ?></td> -->
                <td><?= $dt['nopofk'] ?></td>
                <td><?= $dt['date_transaction'] ?></td>
                <td><?= $dt['store_transaction'] ?></td>
                <td><?= $dt['warehouse_transaction'] ?></td>
                <td><?php 
                $sql = $this->db->query("SELECT SUM(qty_26_transdetail+qty_27_transdetail+qty_28_transdetail+qty_29_transdetail
                                  +qty_30_transdetail+qty_31_transdetail+qty_32_transdetail+qty_33_transdetail
                                  +qty_34_transdetail+qty_35_transdetail+qty_36_transdetail+qty_37_transdetail
                                  +qty_38_transdetail+qty_39_transdetail+qty_40_transdetail+qty_41_transdetail
                                  +qty_42_transdetail+qty_43_transdetail+qty_44_transdetail+qty_45_transdetail) as total
                        FROM tb_transdetail WHERE transaction_transdetail='".$dt['id_transaction']."'");
                $td = $sql->row_array();
                                        
                echo $td['total']; ?></td>
                <td><?= number_format($dt['total_transaction'],0,0,".") ?></td>
                <td><?= b_reference($dt['status_transaction'],"TRX") ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>