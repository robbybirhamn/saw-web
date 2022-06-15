<form action="<?= base_url('import/salesman_process') ?>" method="POST" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-6">
        <label for="">IMPORT SALESMAN</label>
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
        <table class="table table-bordered">
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Tpslm</th>
                <th>Lupdate</th>
                <th>Lupopr</th>
                <th>Status</th>
            </tr>
            <?php foreach ($result as $response) { ?>
                <tr>
                    <td><?= $response['code'] ?></td>
                    <td><?= $response['name'] ?></td>
                    <td><?= $response['telpslm'] ?></td>
                    <td><?= $response['tpslm'] ?></td>
                    <td><?= $response['lupdate'] ?></td>
                    <td><?= $response['lupopr'] ?></td>
                    <td><?= $response['status'] ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
    </div>
</div>
</form>