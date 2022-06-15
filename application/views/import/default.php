<form action="<?= base_url($action_link) ?>" method="POST" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-6">
        <label for=""><?= $title ?></label>
        <div class="input-group">
            <input type="file" class="form-control" name="filedata">
            <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">UPLOAD</button>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
    <?php if(isset($result)){ ?>
        <h4>Konfirmasi Data Export</h4>
        <table>
            <tr>
                <td>Jumlah Masuk</td>
                <td><?= $result['insert'] ?></td>
            </tr>
            <tr>
                <td>Jumlah Update</td>
                <td><?= $result['update'] ?></td>
            </tr>
            <tr>
                <td>Jumlah Data</td>
                <td><?= $result['insert']+$result['update'] ?></td>
            </tr>
        </table>
    <?php } ?>
    </div>
</div>
</form>