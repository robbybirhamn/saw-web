<form action="<?= base_url('user/change_password') ?>" method="POST">
<div class="row">
    <div class="col-md-3">
        <label for="">Password Lama</label>
        <input type="password" name="old_password" id="old_password" class="form-control" required>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label for="">Password Baru</label>
        <input type="password" name="new_password" id="new_password" class="form-control" required>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label for="">Konfirmasi Password Baru</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
    </div>
</div>
<span><?= $message ?></span>
<br>
<div class="row">
    <div class="col-md-3">
        <button class="btn btn-primary" type="submit">SIMPAN</button>
    </div>
</div>
</form>