<form action="<?= base_url('dbf/import_proses') ?>" method="POST" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-6">
        <label for="">DBF FILE</label>
        <input type="file" class="form-control" name="dbf">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <button class="btn btn-primary">PROSES</button>
    </div>
</div>
</form>