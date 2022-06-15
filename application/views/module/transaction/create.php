<?php 
$level = getLevel();

$store_code = $this->session->store_id;

if($store_code == NULL)
{
    echo "<script>alert('pastikan sudah memilih toko!')</script>";
}
?>
<form action="<?= base_url('transaction/store');?>" method="POST" id="form">
<div class="row">
    <!-- <?php if($level == "TK"){ ?>
    <div class="col-md-3">
        <label for="">Toko</label>
        <select name="store" id="store" class="form-control" readonly>
            <?php foreach($stores as $store){?>
                <option value="<?= $store['kode_store'] ?>"><?= $store['kode_store']." - ".$store['name_store'] ?></option>
            <?php } ?>
        </select>
    </div>
    <?php }else{?>
    <div class="col-md-3">
        <label for="">Toko</label>
        <select name="store" id="store" class="form-control select2">
            <option value="">pilih toko</option>
            <?php foreach($stores as $store){?>
                <option value="<?= $store['kode_store'] ?>"><?= $store['kode_store']." - ".$store['name_store'] ?></option>
            <?php } ?>
        </select>
    </div>
    <?php } ?> -->
    
    <div class="col-md-3">
        <label for="">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>">

        <!-- STORE CODE -->
        <input type="hidden" name="store" value="<?= $store_code ?>">
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <td colspan="6"><select name="produk[]" id="produk" class="form-control produk productElement" style="width:250px"></select></td>
                </tr>
                <tr>
                    <th width="10%">Size</th>
                    <th width="10%">Qty</th>
                    <th>Stok Akhir</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th width="10%">-</th>
                </tr>
            </thead>
            <tbody id="tbody-form">
                <tr>
                    <td>
                        <select name="fSize[]" id="fSize" class="form-control sizeElement fSize"></select>
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control fQty" id="fQty" name="fQty[]" value="1">
                    </td>
                    <td>
                        <input type="text" class="form-control lastStok" id="lastStok" name="lastStok[]" value="0" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control price" id="price" name="price[]" value="0">
                    </td>
                    <td>
                        <input type="text" class="form-control subtotal" id="subtotal" name="subtotal[]" value="0" readonly>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary btn-plus" type="button"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-sm btn-danger btn-remove" type="button"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" align="right">Diskon(%)</td>
                    <td><input type="text" class="form-control" id="discount" name="discount" value="0" readonly></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" align="right">Potongan</td>
                    <td><input type="text" class="form-control" id="potongan" name="potongan" value="0"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" align="right">Pajak</td>
                    <td>
                        <input type="hidden" class="form-control" id="spajak" name="spajak" value="0">
                        <input type="text" class="form-control" id="pajak" name="pajak" value="0">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" align="right">Total</td>
                    <td><input type="text" class="form-control" id="total" name="total" value="0" readonly></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="center">
                        <p>*)stok kosong tidak terdaftar</p>
                        <button class="btn btn-primary" id="btn-simpan" type="button"><i class="fa fa-plus"></i> tambah</button>
                        <button class="btn btn-default" id="btn-reset" type="button" onclick="resetForm()"><i class="fa fa-refresh"></i> reset</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" style="font-size:10px !important;">
            <thead>
                <tr>
                    <th>-</th>
                    <th>Produk</th>
                    <?php for ($i=27; $i <= 45 ; $i++) { ?>
                        <th><?= $i ?></th>
                    <?php } ?>
                    <th>Total</th>
                    <th>Diskon</th>
                    <th>Potongan</th>
                    <th>Pajak</th>
                    <th>Net</th>
                </tr>
            </thead>
            <tbody id="tbody-detail"></tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <hr>
        <button class="btn btn-primary">SIMPAN</button>
    </div>
</div>
</form>

<script>
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });
    });
    function selectRefresh(){
        var store = $('#store').val();
        var produk = $('#produk').val();
        
        $('.productElement').select2({
            placeholder: "Pilih produk",
            ajax: {
                url: '<?= base_url('model/getProductWhere/'.$store_code) ?>',
                dataType: 'json'
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        });
        $('.sizeElement').select2({
            placeholder: "Pilih ukuran",
            ajax: {
                url: '<?= base_url('model/getSize/') ?>'+produk,
                dataType: 'json'
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        });
    }
    function resetForm()
    {
        var html = `<tr>
                        <td>
                            <select name="fSize[]" id="fSize" class="form-control sizeElement fSize"></select>
                        </td>
                        <td>
                            <input type="number" min="0" class="form-control fQty" id="fQty" name="fQty[]" value="1">
                        </td>
                        <td>
                            <input type="text" class="form-control lastStok" id="lastStok" name="lastStok[]" value="0" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control price" id="price" name="price[]" value="0">
                        </td>
                        <td>
                            <input type="text" class="form-control subtotal" id="subtotal" name="subtotal[]" value="0" readonly>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-plus" type="button"><i class="fa fa-plus"></i></button>
                            <button class="btn btn-sm btn-danger btn-remove" type="button"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>`;
        $('#tbody-form').html(html);
        selectRefresh();
    }
    function getTotal() {
        var sum = 0;
        $(".subtotal").each(function(){
            sum += +$(this).val();
        });
        var discount = Number($('#discount').val());
        var potongan = Number($('#potongan').val());
        var spajak = Number($('#spajak').val());

       // var total = (sum-(sum*discount/100))-potongan;
        // TOTAL EDIT ZAKKI /////
        var diskon1 = discount/100;
        var diskon = sum*diskon1;
        var total = sum-potongan-diskon;
        ///////////////
        
        if(spajak == 1)
        {
            $('#pajak').val(total*0.1);
            total = total + (total*0.1);
        }else{
            $('#pajak').val(0);
        }
        $('#total').val(total);
    }
    function getSubtotal(elem) {
        var product = $('#produk').val();
        var qty = $(elem).parent().parent().find(".fQty");
        var size = $(elem).parent().parent().find(".fSize");
        var lastStok = $(elem).parent().parent().find(".lastStok");
        var price = $(elem).parent().parent().find(".price");
        var subtotal = $(elem).parent().parent().find(".subtotal");
        
        if(size.val() == null)
        {
            // alert("harap masukan ukuran!");
            console.log('ukuran belum dimasukkan');
        }else{
            $.ajax({
            url:"<?=base_url()?>model/getProduct/"+product,
            type:"get",
            data : {
                size:size.val(),
                warehouse : $('#store').val()
            },
            success:function (response) {
                var json = $.parseJSON(response);

                if(json.stok == 0 || json.stok == null)
                {
                    alert("stok kosong!");
                }else{
                    price.val(json.price_product)
                    stok = json.stok;
                    lastStok.val(stok)
                    
                    var qtyVal = Number(qty.val());
                    var priceVal = Number(price.val());
                    var subtotalVal = qtyVal*priceVal;
                    
                    if(qtyVal > stok){
                        alert("stok maksimum "+stok);
                        qty.val(stok)
                    }

                    subtotal.val(subtotalVal);
                    getTotal();
                }
            }
        });
        selectRefresh();
        }
    }
    $(document).ready(function(){
        selectRefresh();

        $('#accordionSidebar').addClass('toggled');

        $('#produk').change(function(){
            getSubtotal(this);
            selectRefresh();
        });


        $('#potongan').change(function(){
            getTotal();
        });

        $('#store').change(function(){
            // var discount = $('#discount');
            // var store = $(this).val();
            // $.ajax({
            //     url:"<?=base_url()?>model/getStore/",
            //     type:"get",
            //     data : {
            //         store : $('#store').val()
            //     },
            //     success:function (response) {
            //         var json = $.parseJSON(response);
            //         discount.val(json.margin_store);
            //     }
            // });

            // discount.val();
            // getTotal();
            selectRefresh();
        });

        $('.productElement').change(function(){
            var discount = $('#discount');
            var spajak = $('#spajak');
            var potongan = $('#potongan');
            var product = $(this).val();
            $.ajax({
                url:"<?=base_url()?>model/getDiscount/",
                type:"get",
                data : {
                    store : $('#store').val(),
                    product : product
                },
                success:function (response) {
                    var json = $.parseJSON(response);
                    discount.val(json.discount);
                    spajak.val(json.tax);
                    potongan.val(json.potongan);
                    getTotal();
                }
            });
        });

        $('#tbody-form').on('change', '.fQty', function(){
            getSubtotal(this);
        });
        $('#tbody-form').on('change', '.fSize', function(){
            getSubtotal(this);
        });
        $('#tbody-form').on('change', '.discount', function(){
            getSubtotal(this);
        });
        $('#tbody-form').on('change', '.potongan', function(){
            getSubtotal(this);
        });

        $('#tbody-form').on('click', '.btn-plus', function(){
            var html = `<tr>
                            <td>
                                <select name="fSize[]" id="fSize" class="form-control sizeElement fSize"></select>
                            </td>
                            <td>
                                <input type="number" min="0" class="form-control fQty" id="fQty" name="fQty[]" value="1">
                            </td>
                            <td>
                                <input type="text" class="form-control lastStok" id="lastStok" name="lastStok[]" value="0" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control price" id="price" name="price[]" value="0">
                            </td>
                            <td>
                                <input type="text" class="form-control subtotal" id="subtotal" name="subtotal[]" value="0" readonly>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-plus" type="button"><i class="fa fa-plus"></i></button>
                                <button class="btn btn-sm btn-danger btn-remove" type="button"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;
            $('#tbody-form').append(html);
            selectRefresh();
        });

        // DELETE
        $('#tbody-form').on('click', '.btn-remove', function(){
            var countCard = $('#tbody-form .btn-plus').length;
            if(countCard > 1)
            {
                $(this).closest ('tr').remove();
            }
        });

        $('#tbody-detail').on('click', '.btn-rm', function(){
            $(this).closest ('tr').remove();
        });

        $('#btn-simpan').on('click',function () {
            var produk = $("#produk").val();
            var discount = $("#discount").val();
            var potongan = $("#potongan").val();
            var pajak = $("#pajak").val();
            var fsize = $("select[name='fSize[]']").map(function(){return $(this).val();}).get();
            var fqty = $("input[name='fQty[]']").map(function(){return $(this).val();}).get();
            var lastStok = $("input[name='lastStok[]']").map(function(){return $(this).val();}).get();
            var price = $("input[name='price[]']").map(function(){return $(this).val();}).get();
            var subtotal = $("input[name='subtotal[]']").map(function(){return $(this).val();}).get();
            
            $.ajax({
                url:"<?=base_url()?>model/stock/",
                type:"POST",
                data : { 
                    fsize : fsize,
                    fqty : fqty,
                    produk : produk,
                    lastStok : lastStok,
                    price : price,
                    discount : discount,
                    potongan : potongan,
                    pajak : pajak,
                    subtotal : subtotal,
                 },
                success:function (response) {
                    $('#tbody-detail').append(response);
                    resetForm();
                }
            });
        })
        
    });
</script>