<style>
.load-wrapp {
  float: left;
  width: 100px;
  height: 100px;
  margin: 0 10px 10px 0;
  padding: 10px 10px 10px;
  border-radius: 5px;
  text-align: center;
  background-color: #d8d8d8;
}

.load-wrapp p {
  padding: 0 0 10px;
}
.load-wrapp:last-child {
  margin-right: 0;
}

.line {
  display: inline-block;
  width: 15px;
  height: 15px;
  border-radius: 15px;
  background-color: #4b9cdb;
}

.load-1 .line:nth-last-child(1) {
  animation: loadingA 1.5s 1s infinite;
}
.load-1 .line:nth-last-child(2) {
  animation: loadingA 1.5s 0.5s infinite;
}
.load-1 .line:nth-last-child(3) {
  animation: loadingA 1.5s 0s infinite;
}

@keyframes loadingA {
  0 {
    height: 15px;
  }
  50% {
    height: 35px;
  }
  100% {
    height: 15px;
  }
}

input,
textarea {
  border: 1px solid #eeeeee;
  box-sizing: border-box;
  margin: 0;
  outline: none;
  padding: 10px;
}

input[type="button"] {
  -webkit-appearance: button;
  cursor: pointer;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.input-group {
  clear: both;
  margin: 15px 0;
  position: relative;
}

.input-group input[type='button'] {
  background-color: #eeeeee;
  min-width: 38px;
  width: auto;
  transition: all 300ms ease;
}

.input-group .button-minus,
.input-group .button-plus {
  font-weight: bold;
  height: 38px;
  padding: 0;
  width: 38px;
  position: relative;
}

.input-group .quantity-field {
  position: relative;
  height: 38px;
  left: -6px;
  text-align: center;
  width: 62px;
  display: inline-block;
  font-size: 13px;
  margin: 0 0 5px;
  resize: vertical;
}

.button-plus {
  left: -13px;
}

input[type="number"] {
  -moz-appearance: textfield;
  -webkit-appearance: none;
}

</style>

<div class="load-wrapp" id="loading">
  <div class="load-1">
    <p>Loading</p>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
  </div>
</div>

<div id="view" style="display:none">
<?php 
$level = getLevel();
?>
<form action="<?= base_url('cart/add_process') ?>" id="myForm" method="POST">
    <?php 
    $store_code = $this->session->store_id;
    ?>
    <div class="row">
        <div class="col-md-12">
            <h3><?= $product['code_product']." ".$product['name_product'] ?></h3>
        </div>
        <div class="col-md-3">
            <input type="hidden" name="code_product" value="<?= $product['code_product'] ?>">
            <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
            <input type="hidden" name="name_product" value="<?= $product['name_product'] ?>">
            <label for="">Kode Toko</label>
            <input type="text" value="<?= $store_code ?>" id="store" class="form-control" readonly>
        </div>
        <br>
        <div class="col-md-12">
            <label for="">Pilih ukuran</label>
            <br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <?php foreach ($sizes as $size) { ?>
                <label class="btn btn-secondary">
                    <input type="radio" name="size" id="<?= $size['text'] ?>" value="<?= $size['id'] ?>" autocomplete="off"> <?= $size['text'] ?>
                </label>
                <?php } ?>
                <input type="hidden" name="size_label" value="" id="size_label">
            </div>
        </div>

        <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Qty</th>
                <td>
                    <div class="input-group">
                        <input type="button" value="-" class="button-minus" data-field="quantity">
                        <input type="number" step="1" max="" value="1" name="quantity" id="qty" class="quantity-field" required onchange="checkMax()">
                        <input type="button" value="+" class="button-plus" data-field="quantity">
                    </div>
                    <input type="hidden" id="stok_max">
                </td>
            </tr>
            <tr>
                <th>Stok Tersedia</th>
                <td><span id="qty_label">0</span></td>
            </tr>
            <tr>
                <th>Harga Produk</th>
                <td><input type="number" name="price" value="<?= $product['price_product'] ?>" id="price" readonly class="form-control"></td>
            </tr>
            <tr>
                <th>Potongan</th>
                <td><input type="number" name="potongan" value="0" id="potongan" class="form-control" onkeyup="setSubtotal()" readonly></td>
            </tr>
            <tr>
                <th>Diskon</th>
                <td><input type="number" name="diskon" value="0" id="diskon" class="form-control" readonly></td>
            </tr>
            <tr>
                <th>Pajak</th>
                <td><input type="number" name="pajak" value="0" id="pajak" class="form-control" onkeyup="setSubtotal()" readonly></td>
            </tr>
            <tr>
                <th>Subtotal</th>
                <td><input type="number" name="subtotal" value="0" id="subtotal" readonly class="form-control"></td>
            </tr>
        </table>
        </div>
    </div>
    <div class="row">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">ADD TO CART</button>
            <a href="<?= base_url('product') ?>"><button type="button" class="btn btn-default">KEMBALI</button></a>
        </div>
    </div>
</form>
</div>
<script>
function checkMax() {
    var max = $("#stok_max").val();
    var qty = $("#qty").val();
    if(Number(qty) > Number(max))
    {
        alert("Melebihi stok tersedia");
        $("#qty").val(max);
    }
    setSubtotal();
}

function setSubtotal() {
    var qty = $('#qty');
    var price = $('#price');
    var discount = $('#diskon');
    var spajak = $('#pajak');
    var potongan = $('#potongan');
    var subtotal = $('#subtotal');
    var product = "<?= $product['id_product'] ?>";

    var priceQty = Number(price.val());
    var priceCut = priceQty-Number(potongan.val());

    var priceCut1 = priceCut*Number(discount.val())/100;
    var priceCut2 = priceCut-priceCut1;
    var pajaks = (Number(qty.val())*priceCut2) * Number(spajak.val())/100;
    var subtotalxx = (Number(qty.val())*priceCut2)+pajaks;
    subtotal.val(subtotalxx);
}

function getDiskon() {
    var price = $('#price');
    var discount = $('#diskon');
    var spajak = $('#pajak');
    var potongan = $('#potongan');
    var subtotal = $('#subtotal');
    var product = "<?= $product['id_product'] ?>";
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
            
            setSubtotal();
            // var subtotalxx = ((Number(price.val())-Number(json.potongan))-(Number(price.val())*discount.val()/100))-Number(json.tax);
            
            // subtotal.val(subtotalxx);
        }
    });
}

$(document).ready(function(){
    $("#view").show();
    $("#loading").hide();
    
    $('input[name=size]').change(function(){
        var size = $('input[name=size]:checked', '#myForm').val();
        var size_label = $('input[name=size]:checked', '#myForm').attr("id");
        $.ajax({
            url:"<?=base_url()?>model/getProduct/<?= $product['id_product'] ?>",
            type:"get",
            data : {
                size:size,
                warehouse : $('#store').val()
            },
            beforeSend: function ( xhr ) {
                $("#loading").show();
                $("#view").hide();
            },
            success:function (response) {
                var json = $.parseJSON(response);
                var size_max = json.stok;
                $('#qty_label').html(size_max+" pcs");
                $('#stok_max').val(size_max);
                $('#size_label').val(size_label);

                // update price
                $('#price').val(json.price_product);
                
                $("#loading").hide();
                $("#view").show();

                getDiskon();
            }
        });
    });
});
</script>

<script>
function incrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data('field');
  var parent = $(e.target).closest('div');
  var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  if (!isNaN(currentVal)) {
    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
  } else {
    parent.find('input[name=' + fieldName + ']').val(0);
  }
  checkMax();
}

function decrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data('field');
  var parent = $(e.target).closest('div');
  var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  if (!isNaN(currentVal) && currentVal > 0) {
    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
  } else {
    parent.find('input[name=' + fieldName + ']').val(0);
  }
  checkMax();
}

$('.input-group').on('click', '.button-plus', function(e) {
  incrementValue(e);
});

$('.input-group').on('click', '.button-minus', function(e) {
  decrementValue(e);
});

</script>
