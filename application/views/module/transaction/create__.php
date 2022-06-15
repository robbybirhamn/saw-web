<!-- <form action="<?= base_url('crud/store') ?>" method="POST"> -->
<div class="row">
    <div class="col-md-3">
        <label for="">Toko</label>
        <select name="store" id="store" class="form-control select2">
            <?php foreach($stores as $store){?>
                <option value="<?= $store['id_store'] ?>"><?= $store['name_store'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="">Nomor Booking</label>
        <input type="text" class="form-control" name="noipfk">
    </div>
    <div class="col-md-3">
        <label for="">Nomor Faktur</label>
        <input type="text" class="form-control" name="nofk">
    </div>
    <div class="col-md-3">
        <label for="">Gudang</label>
        <select name="warehouse" id="warehouse" class="form-control select2">
            <?php foreach($warehouses as $warehouse){?>
                <option value="<?= $warehouse['id_warehouse'] ?>"><?= $warehouse['name_warehouse'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="">Divisi</label>
        <select name="division" id="division" class="form-control select2">
            <?php foreach($divisions as $division){?>
                <option value="<?= $division['id_division'] ?>"><?= $division['name_division'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="">Margin</label>
        <input type="number" min="0" class="form-control" value="0" name="margin">
    </div>
    <div class="col-md-3">
        <label for="">Diskon</label>
        <input type="number" min="0" class="form-control" value="0" name="diskon">
    </div>
    <div class="col-md-3">
        <label for="">Potongan</label>
        <input type="number" min="0" class="form-control" value="0" name="potongan">
    </div>
    <div class="col-md-6">
        <label for="">Nomor Pajak</label>
        <input type="text" class="form-control" name="nopajak">
    </div>
    <div class="col-md-3">
        <label for="">Status Faktur</label>
        <select name="faktur" id="faktur" class="form-control select2">
            <option value="KO">Konsinyasi</option>
            <option value="KN">Konsinyasi Non PKP</option>
            <option value="PP">Putus Ppn</option>
            <option value="PN">Putus Non Ppn</option>
        </select>
    </div>
    <div class="col-md-12">
        <label for="">Keterangan</label>
        <textarea name="description" id="description" class="form-control" rows="2"></textarea>
    </div>
</div>
<hr>
<!-- <form action="<?= base_url('model/stock');?>" method="POST" id="form"> -->
<div class="row">
    <div class="col-md-3">
        <label for="">Produk</label>
        <select name="produk" id="produk" class="form-control select2">
            <?php foreach($products as $product){?>
                <option value="<?= $product['code_product'] ?>"><?=   $product['code_product']."-".$product['name_product'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="">Sorting</label>
        <select name="sorting" id="sorting" class="form-control select2">
            <option value="1">S.I</option>
            <option value="2">S.II</option>
            <option value="3">S.III</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="">Komposisi</label>
        <input type="text" name="komposisi" id="komposisi" class="form-control" placeholder="komposisi">
    </div>
    <div class="col-md-2">
        <label for="">Qty(Lusin)</label>
        <input type="text" class="form-control" name="qtylusin" id="qtylusin" value="0">
    </div>
    <div class="col-md-2">
        <label for="">Qty(Pcs)</label>
        <input type="text" class="form-control" name="qtypcs" id="qtypcs" value="0">
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Size</th>
                    <th>Qty</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody id="tbody-form">
                <tr>
                    <td>
                        <input type="number" min="26" max="45" class="form-control fSize" id="fSize" name="fSize[]" value="26">
                    </td>
                    <td>
                        <input type="text" class="form-control fQty" id="fQty" name="fQty[]" value="0">
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary btn-plus" type="button"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-sm btn-danger btn-remove" type="button"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <label for="">Price</label>
        <input type="text" name="price" id="price" class="form-control">
    </div>
    <div class="col-md-2">
        <label for="">Pot Price</label>
        <input type="text" name="potprice" id="potprice" class="form-control">
    </div>
    <div class="col-md-2">
        <label for="">Margin</label>
        <input type="text" name="margin" id="margin" class="form-control">
    </div>
    <div class="col-md-2">
        <label for="">Net.Price</label>
        <input type="text" name="netprice" id="netprice" class="form-control">
    </div>
    <div class="col-md-2">
        <label for="">Total</label>
        <input type="text" name="total" id="total" class="form-control">
    </div>
    <div class="col-md-6">
        <label for="">&nbsp;</label><br>
        <button class="btn btn-primary" id="btn-simpan" type="button"><i class="fa fa-plus"></i> tambah</button>
        <button class="btn btn-default" id="btn-reset" type="button"><i class="fa fa-refresh"></i> reset</button>
    </div>
</div>
<!-- </form> -->
<br>
<div class="row">
    <div class="col-md-12">
    <table class="table table-bordered" id="tableStok" style="font-size:10px !important;display:none;">
        <label for="">Data Stok per Size</label>
        <thead>
            <tr>
                <?php for ($i=26; $i <= 45 ; $i++) { ?>
                    <th style="text-align: center;"><?= $i ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody id="tbody-stock">
            <tr>
                <?php for ($i=26; $i <= 45 ; $i++) { ?>
                    <td style="text-align: center;"></td>
                <?php } ?>
            </tr>
        </tbody>
    </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-responsive" style="font-size:9px !important;">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Sorting</th>
                    <th>Komposisi</th>
                    <th>Qty <br> (Lsn)</th>
                    <th>Qty <br>(pcs)</th>
                    <?php for ($i=26; $i <= 45 ; $i++) { ?>
                        <th><?= $i ?></th>
                    <?php } ?>
                    <th>Price</th>
                    <th>Pot.Price</th>
                    <th>Margin</th>
                    <th>Net.Price</th>
                    <th>Total</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody id="tbody-detail">
                <tr>
                    <td><input type="hidden" value="" class="product" name="product[]"> <span class="label_produk">PRODUK</span></td>
                    <td><input type="hidden" style="width: 75px;" value="" class="sorting" name="product[]"> <span class="label_sorting">SORTING</span></td>
                    <td><input type="hidden" name="komposisi[]" style="width: 75px;"> <span class="label_komposisi">KOMPOSISI</span></td>
                    <td><input type="hidden" name="qty_lusin[]" style="width: 50px;" value="0"> <span class="label_qty_lusin">0</span></td>
                    <td><input type="hidden" name="qty_pcs[]" style="width: 50px;" value="0"> <span class="label_qty_pcs">0</span></td>
                    <?php for ($i=26; $i <= 45 ; $i++) { ?>
                        <td><input type="hidden" name="qty_<?= $i ?>[]" style="width: 25px;" value="0"> <span class="label_qty_<?= $i ?>">0</span></td>
                    <?php } ?>
                    <td><input type="hidden" style="width: 100px"> <span class="label_price">0</span></td>
                    <td><input type="hidden" style="width: 100px"> <span class="label_potprice">0</span></td>
                    <td><input type="hidden" style="width: 100px;"> <span class="label_margin">0</span></td>
                    <td><input type="hidden" style="width: 100px;"> <span class="label_netprice">0</span></td>
                    <td><input type="hidden" style="width: 100px;" readonly> <span class="label_total">0</span></td>
                    <td>
                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <hr>
        <button class="btn btn-primary">SIMPAN</button>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#accordionSidebar').addClass('toggled');
        
        $('#tbody-form').on('click', '.btn-plus', function(){
            var html = `<tr>
                            <td>
                                <input type="number" min="26" max="45" class="form-control fSize" id="fSize" name="fSize[]" value="26">
                            </td>
                            <td>
                                <input type="text" class="form-control fQty" id="fQty" name="fQty[]" value="0">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-plus" type="button"><i class="fa fa-plus"></i></button>
                                <button class="btn btn-sm btn-danger btn-remove" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;
            $('#tbody-form').append(html);
        });

        // DELETE
        $('#tbody-form').on('click', '.btn-remove', function(){
            var countCard = $('#tbody-form .btn-plus').length;
            if(countCard > 1)
            {
                $(this).closest ('tr').remove();
            }
        });

        $('#produk').change(function(){
            var product = $(this).val();
            var warehouse = $('#warehouse').val();
            $('#tableStok').show();
            $('#tbody-stock').html("");

            $.ajax({
                url:"<?=base_url()?>model/getStock/"+product+"?warehouse="+warehouse,
                type:"get",
                success:function (response) {
                    var json = $.parseJSON(response);
                    console.log(json);
                    var html =`<tr>`;
                        <?php for ($i=26; $i <= 45 ; $i++) { ?>
                            var s = json.AK<?= $i ?>FG;
                            html += `<td>`+s+`</td>`;
                        <?php } ?>
                    html += `</tr>`;
                    $('#tbody-stock').append(html);
                    console.log(json);
                }
            });

        });

        $('#btn-simpan').on('click',function () {
            var produk = $('#produk').val();
            var sorting = $('#sorting').val();
            var komposisi = $('#komposisi').val();
            var qtylusin = $('#qtylusin').val();
            var qtypcs = $('#qtypcs').val();
            var fsize = $("input[name='fSize[]']").map(function(){return $(this).val();}).get();
            var fqty = $("input[name='fQty[]']").map(function(){return $(this).val();}).get();
            var price = $('#price').val();
            var potprice = $('#potprice').val();
            var margin = $('#margin').val();
            var netprice = $('#netprice').val();
            var total = $('#total').val();

            $.ajax({
                url:"<?=base_url()?>model/stock/",
                type:"POST",
                data : { 
                    produk : produk,
                    sorting : sorting,
                    komposisi : komposisi,
                    qtylusin : qtylusin,
                    qtypcs : qtypcs,
                    fsize : fsize,
                    fqty : fqty,
                    price : price,
                    potprice : potprice,
                    margin : margin,
                    netprice : netprice,
                    total : total
                 },
                success:function (response) {
                    $('#tbody-detail').append(response);
                }
            });
        })
    });
</script>