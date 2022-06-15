<a href="<?= base_url('crud/create') ?>">
    <button class="btn btn-primary">TAMBAH DATA</button>
</a>
<hr>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>RFID</th>    
        <th>Nama</th>
        <th>TTL</th>
        <th>Jabatan</th>
        <th>Email</th>
        <th>Kontak</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
        <?php foreach ($data as $dt) { ?>
            <tr>
                <td><?= $dt['rfid'] ?></td>
                <td><?= $dt['name'] ?></td>
                <td><?= $dt['tmp_lahir'].",".$dt['tgl_lahir'] ?></td>
                <td><?= $dt['jabatan'] ?></td>
                <td><?= $dt['email'] ?></td>
                <td><?= $dt['kontak'] ?></td>
                <td><?= $dt['alamat'] ?></td>
                <td>
                    <a href="<?= base_url('crud/edit/'.$dt['id']); ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                    <a href="<?= base_url('crud/delete/'.$dt['id']); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>