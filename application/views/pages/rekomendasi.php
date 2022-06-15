<form action="<?= base_url('rekomendasi/hasil') ?>" method="GET">
    <h1>Pilih Kriteria</h1>
    <table>
        <tr>
            <td>Dekorasi</td>
            <td>
                <select name="dekorasi" id="dekorasi">
                    <option value="1">Tidak Penting</option>
                    <option value="2">Cukup Penting</option>
                    <option value="3">Penting</option>
                    <option value="4">Sangat Penting</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Rias</td>
            <td>
                <select name="rias" id="rias">
                <option value="1">Tidak Penting</option>
                    <option value="2">Cukup Penting</option>
                    <option value="3">Penting</option>
                    <option value="4">Sangat Penting</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Catering</td>
            <td>
                <select name="catering" id="catering">
                <option value="1">Tidak Penting</option>
                    <option value="2">Cukup Penting</option>
                    <option value="3">Penting</option>
                    <option value="4">Sangat Penting</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Jumlah Tamu</td>
            <td>
                <select name="jumlah_tamu" id="jumlah_tamu">
                <option value="1">Tidak Penting</option>
                    <option value="2">Cukup Penting</option>
                    <option value="3">Penting</option>
                    <option value="4">Sangat Penting</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>
                <select name="harga" id="harga">
                <option value="1">Tidak Penting</option>
                    <option value="2">Cukup Penting</option>
                    <option value="3">Penting</option>
                    <option value="4">Sangat Penting</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button name="proses" value="proses">PROSES</button>
            </td>
        </tr>
    </table>
</form>

<h5>Rekomendasi Paket</h5>
<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Vendor</th>
        <th>Nama Paket</th>
        <th>Dekorasi</th>
        <th>Rias</th>
        <th>Catering</th>
        <th>Jumlah Tamu</th>
        <th>Harga</th>
        <th>Nilai Rekomendasi</th>
        <th>Kontak</th>
    </tr>
    <?php 
    $no = 1;
    foreach ($results as $result) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $result['nama_vendor'] ?></td>
            <td><?= $result['name_packet'] ?></td>
            <td><?= $result['dekorasi_nilai'] ?></td>
            <td><?= $result['rias_nilai'] ?></td>
            <td><?= $result['catering_nilai'] ?></td>
            <td><?= $result['jumlah_tamu'] ?></td>
            <td><?= $result['harga'] ?></td>
            <td><?= $result['total'] ?></td>
            <td>
                <a href="">DETAIL</a>
            </td>
        </tr>
    <?php } ?>
</table>