<form action="<?= base_url('crud/update/'.$id) ?>" method="POST">
<div class="row">
    <div class="col-md-6">
        <label for="">RFID</label>
        <input type="text" class="form-control" name="rfid" value="<?= $data['rfid'] ?>">
    </div>
    <div class="col-md-6">
        <label for="">Nama Lengkap</label>
        <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>">
    </div>
    <div class="col-md-6">
        <label for="">Tempat Lahir</label>
        <input type="text" class="form-control" name="tmp_lahir" value="<?= $data['tmp_lahir'] ?>">
    </div>
    <div class="col-md-6">
        <label for="">Tanggal Lahir</label>
        <input type="date" class="form-control" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>">
    </div>
    <div class="col-md-6">
        <label for="">Jabatan</label>
        <input type="text" class="form-control" name="jabatan" value="<?= $data['jabatan'] ?>">
    </div>
    <div class="col-md-6">
        <label for="">Email</label>
        <input type="text" class="form-control" name="email" value="<?= $data['email'] ?>">
    </div>
    <div class="col-md-6">
        <label for="">Kontak</label>
        <input type="text" class="form-control" name="kontak" value="<?= $data['kontak'] ?>">
    </div>
    <div class="col-md-6">
        <label for="">Alamat</label>
        <input type="text" class="form-control" name="alamat" value="<?= $data['alamat'] ?>">
    </div>
    <div class="col-md-6">
        <label for="">Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="col-md-12 text-center">
        <hr>
        <button class="btn btn-primary">SIMPAN</button>
    </div>
</form>
</div>