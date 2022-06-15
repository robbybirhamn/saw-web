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

</style>

<!-- <div class="load-wrapp" id="loading">
  <div class="load-1">
    <p>Loading</p>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
  </div>
</div> -->

<div id="view" style="display:block">
<?php 
$level = getLevel();

    $store_code = $this->session->store_id;
    ?>
    <form action="<?= base_url('transaction_v2/store');?>" method="POST" id="form">
    <div class="row">
        <div class="col-md-3">
            <label for="">Nama Customer</label>
            <input type="text" value="<?= $store_code ?>" id="store" name="store" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-3">
        <label for="">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>">
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="">Produk</label>
            <select name="produk" id="produkSelect" class="form-control produk productElement" style="width:250px" required>
                <option value="<?= $product['id_product'] ?>"><?= $product['code_product']." - ".$product['name_product'] ?></option>
            </select>
        </div>
    </div>
    <hr>
        <div id="add_row">
        </div>
        
        <hr>
        </form>
</div>

<script>
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

function addCart() {
    var total = $("#total").val();
    var produk = $("#produk").val();
    var discount = $("#diskon").val();
    var potongan = $("#potongan").val();
    var harga = $("#harga").val();
    var pajak = $("#pajakrp").val();
    var fsize = $("input[name='order[]']").map(function(){return $(this).val();}).get();
    var subtotal = $("#subtotal").val();
    
    $.ajax({
        url:"<?=base_url()?>model/stock_new/",
        type:"POST",
        data : { 
            total : total,
            fsize : fsize,
            produk : produk,
            discount : discount,
            potongan : potongan,
            pajak : pajak,
            subtotal : subtotal,
            price : harga,
            },
        success:function (response) {
            var obj = jQuery.parseJSON(response);
            console.log(obj);
            if(obj.message == "1")
            {
                document.location.href = "<?= base_url('transaction_v2/create/'.$product['id_product']) ?>"
            }else{
                alert('Qty '+obj.data+' tidak boleh melebihi stok!');
                document.location.href = "<?= base_url('transaction_v2/create/'.$product['id_product']) ?>"
            }
        }
    });
}


function updateTotal() {
    $('.order').each(function(){
        var totalPoints = 0;
        $(this).find('input').each(function(){
            totalPoints += parseInt($(this).val()); //<==== a catch  in here !! read below
        });
        $('#total').val(totalPoints);
    });
    setSubtotal();
}

function setSubtotal() {
    var qty = $('#total');
    var price = $('#harga');
    var discount = $('#diskon');
    var spajak = $('#pajak');
    var potongan = $('#potongan');
    var subtotal = $('#subtotal');

    //potong dulu
    var prc = Number(price.val())-Number(potongan.val());
    
    //dikali qty
    var priceQty = Number(qty.val())*prc;
    var priceCut = priceQty;
    
    //ambil diskon
    var priceCut1 = priceQty*Number(discount.val())/100;
    
    //dikurangi diskon
    var priceCut2 = priceCut-priceCut1;
    var pajaks = (priceCut2) * Number(spajak.val())/100;
    var subtotalxx = priceCut2; //UPDATE ROBBY, MENGHILANGKAN PAJAK
    subtotal.val(subtotalxx);

    var tax = $('#pajak').val();
    console.log(tax);
    var taxrp = tax*priceCut2/100;
    console.log(priceCut2);
    $('#pajakrp').val(taxrp);
}

function checkMax(elem,max) {
    if(elem.val() > max)
    {
        alert('melebihi stok');
        elem.val(max)
        updateTotal()
    }

    if(elem.val() < 0)
    {
        alert('stok tidak boleh dibawah 0');
        elem.val(1)
        updateTotal()
    }
}

function getViewStock() {
    var prd = $('#produkSelect').val();
    $.ajax({
        url:"<?=base_url()?>model/state_add_produk/",
        type:"GET",
        data : { 
            produk : prd,
            },
        success:function (response) {
            $('#add_row').html("");
            $('#add_row').append(response);
        }
    });
}

$(document).ready(function(){
    selectRefresh();
    $('#accordionSidebar').addClass('toggled');

    $('.btn-simpan').on('click',function () {
        var total = $("#total").val();
        var produk = $("#produk").val();
        var discount = $("#diskon").val();
        var potongan = $("#potongan").val();
        var harga = $("#harga").val();
        var pajak = $("#pajak").val();
        var fsize = $("input[name='order[]']").map(function(){return $(this).val();}).get();
        var subtotal = $("#subtotal").val();
        
        $.ajax({
            url:"<?=base_url()?>model/stock_new/",
            type:"POST",
            data : { 
                total : total,
                fsize : fsize,
                produk : produk,
                discount : discount,
                potongan : potongan,
                pajak : pajak,
                subtotal : subtotal,
                price : harga,
                },
            success:function (response) {
                document.location.href = "<?= base_url('transaction_v2/create/'.$product['id_product']) ?>"
            }
        });
    });
    
    getViewStock();
    $('#produkSelect').change(function(){
        getViewStock();
    });

    $('#tbody-detail').on('click', '.btn-rm', function(){
        $(this).closest ('tr').remove();
    });
});
</script>