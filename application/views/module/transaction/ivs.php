<div class="row">
    <div class="col-md-3">
        <!-- <a href="<?= base_url('product') ?>">
            <button class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> TAMBAH DATA</button>
        </a> -->
    </div>
    <div class="col-md-9 text-right">
        <?php if(getLevel() == "admin"){?>
        <a href="<?= base_url('ivs/export'."?date_start=$date_start&date_end=$date_end") ?>">
        <button type="button" class="btn btn-success btn-sm">
            <i class="fa fa-table"></i> EXPORT EXCEL
        </button>
        </a>
        <?php } ?>
    </div>
</div>
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
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th width="200px">No</th>    
        <th width="200px">Faktur</th>  
        <!-- <th width="200px">Booking Web</th>   -->
        <th width="200px">Tanggal</th>    
        <th width="200px">Toko</th>
        <th width="200px">QTY</th>
        <th width="200px">Total</th>
        <th width="200px">Booking</th>
        <th width="200px">Tanggal PO</th>
        <th width="200px">Status</th>
    </tr>
    </thead>

    <tbody>
        <?php 
        $no = 1;
        $total = 0;
        $rupiah = 0;
        foreach ($ivs as $dt) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $dt['NOIPFK'] ?></td>
                <!-- <td><?= $dt['NOFK'] ?></td> -->
                <td><?= $dt['TGFK'] ?></td>
                <td><?= $dt['CSTFK'] ?>( <?php
                  $sql1 = $this->db->query("SELECT kode_store,name_store
                          FROM ms_store WHERE kode_store='".$dt['CSTFK']."'");
                  $st = $sql1->row_array();

                  echo $st['name_store']; ?> )</td>
                <td><?= $dt['QTYFK'] ?></td>
                <td><?= number_format($dt['VDPPFK'],0,0,".") ?></td>
                <td><?= $dt['NOPOFK'] ?></td>
                <td><?= $dt['TGPOFK'] ?></td>
                <td><?= b_reference($dt['FLAGFK'],"TRX") ?></td>
            </tr>
        <?php 
            $total += $dt['QTYFK'];
            $rupiah += $dt['VDPPFK'];
            } ?>
        <tfoot>
            <td colspan="4">Total</td>
            <td><?= number_format($total,0,0,".") ?></td>
            <td><?= number_format($rupiah,0,0,".") ?></td>
            <td></td>
            <td></td>
        </tfoot>
    </tbody>
</table>
</div>