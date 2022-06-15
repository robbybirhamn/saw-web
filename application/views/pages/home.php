<?php foreach ($banners as $banner) { ?>
    <img src="<?= base_url('uploads/banner/'.$banner['file_banner']) ?>" alt="" height="200px">
<?php } ?>

<h4>Daftar Paket Wedding</h4>
<?php foreach ($packets as $banner) { ?>
    <img src="<?= base_url('uploads/packet/'.$banner['photo_1']) ?>" alt="" height="200px">
<?php } ?>
<br><br><br>
<a href="<?= base_url('rekomendasi') ?>">REKOMENDASI</a>