<?php if(getLevel() == "admin"){ ?>
    <form action="<?= base_url('import/stok_process') ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <span><?= $msg ?? "" ?></span>
                <label for="">IMPORT STOK</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="filedata">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="submit">UPLOAD</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>