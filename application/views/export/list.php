<form action="">
<div class="row">
    <div class="col-md-3">
        <label for="">Tanggal Awal</label>
        <input type="date" class="form-control" name="date_start" value="<?= $date_start ?>">
    </div>
    <div class="col-md-3">
        <label for="">Tanggal Akhir</label>
        <input type="date" class="form-control" name="date_end" value="<?= $date_end ?>">
    </div>
    <div class="col-md-3">
        <label for="">Gudang</label>
        <select name="warehouse" id="warehouse" class="form-control">
            <option value="">semua gudang</option>
            <option value="40" <?= ($warehouse == "40") ? "selected" :"";  ?>>Gudang 40</option>
            <option value="07" <?= ($warehouse == "07") ? "selected" :""; ?>>Gudang 07</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="">&nbsp;</label><br>
        <button class="btn btn-primary">FILTER</button>
    </div>
</div>
</form>
<hr>
<form action="<?= base_url('export/export_dbf') ?>" method="POST">
<div class="table-responsive">
<div class="row">
    <div class="col-md-12">
        <center>
            <!-- <button type="submit" name="action" value="IVH" class="btn btn-success" download="ivh.dbf">DOWNLOAD IVH</button> -->
            <button type="submit" name="action" value="IVD" class="btn btn-success" download="ivd.dbf">DOWNLOAD IVD</button>
            <button type="submit" name="action" value="IMAGE" class="btn btn-success">DOWNLOAD .JPEG</button>
            <button type="submit" name="action" value="EXCEL" class="btn btn-success">DOWNLOAD EXCEL</button>
        </center>
    </div>
</div>
<table class="table table-bordered" id="table-lois" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th><input type="checkbox" onClick="toggle(this)" checked/><br/></th>
        <!-- <th>Faktur Web</th>   -->
        <th>Booking</th>  
        <th>Tanggal</th>    
        <th>Toko</th>
        <th>Gudang</th>
        <th>Total QTY</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
        <?php 
        $no = 1;
        foreach ($transcation as $dt) { ?>
            <tr>
                <td><input type="checkbox" name="trx[]" id="" value="<?= $dt['id_transaction'] ?>" checked class="trx"></td>
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
                <td>
                    <a href="<?= base_url('transaction/detail/'.$dt['id_transaction']); ?>"><button class="btn btn-default btn-sm"><i class="fa fa-eye"></i></button></a>
                    <?php if(getLevel() == "admin")
                    {
                        ?><a href="<?= base_url('transaction/edit/'.$dt['id_transaction']); ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a><?php 
                    } ?>
                    <a href="<?= base_url('transaction/delete/'.$dt['id_transaction']); ?>" onclick="return confirm('yakin ingin menghapus data ini?')"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</form>

<script>
function toggle(source) {
  checkboxes = document.getElementsByClassName('trx');
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