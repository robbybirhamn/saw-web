<div class="row">
    <div class="col-md-3">
        <!-- <a href="<?= base_url('transaction/create') ?>">
            <button class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> TAMBAH DATA</button>
        </a> -->
    </div>
    <div class="col-md-9 text-right">
        <?php if(getLevel() == "admin"){?>
        <a href="<?= base_url('export/transaction_ivh'."?date_start=$date_start&date_end=$date_end") ?>">
            <button class="btn btn-success btn-sm"><i class="fa fa-table"></i> EXPORT HISTORI IVH</button>
        </a>
        <a href="<?= base_url('export/transaction_ivd'."?date_start=$date_start&date_end=$date_end") ?>">
            <button class="btn btn-success btn-sm"><i class="fa fa-table"></i> EXPORT HISTORI IVD</button>
        </a>
        <?php } ?>
    </div>
</div>
<hr>
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
        <th>No</th>    
        <th>Gudang</th>  
        <th>Faktur Web</th>  
        <th>Tanggal</th>    
        <th>Toko</th>
        <th>Gudang</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
        <?php 
        $no = 1;
        foreach ($transcation as $dt) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= get_warehouse($dt['store_transaction']); ?></td>
                <td><?= $dt['nofk_transaction'] ?></td>
                <td><?= $dt['date_transaction'] ?></td>
                <td><?= $dt['store_transaction'] ?></td>
                <td><?= $dt['warehouse_transaction'] ?></td>
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