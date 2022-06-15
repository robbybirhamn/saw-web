<div class="row">
    <div class="col-md-3">
        <a href="<?= base_url('product') ?>">
            <button class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> TAMBAH DATA</button>
        </a>
    </div>
    <div class="col-md-9 text-right">
        <?php if(getLevel() == "admin"){?>
        <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ivsModal">
            <i class="fa fa-table"></i> EXPORT IVS
        </button> -->
        <a href="<?= base_url('export/dbf') ?>">
          <button type="button" class="btn btn-success btn-sm">
              <i class="fa fa-table"></i> EXPORT CHECKLIST
          </button>
        </a>
        <!-- <a href="<?= base_url('export/transaction_ivh') ?>" download="ivh.dbf">
          <button type="button" class="btn btn-success btn-sm">
              <i class="fa fa-table"></i> EXPORT IVH
          </button>
        </a> -->
        <a href="<?= base_url("export/transaction_ivd?date_start=$date_start&date_end=$date_end
        ") ?>" download="ivd.dbf">
          <button type="button" class="btn btn-success btn-sm">
              <i class="fa fa-table"></i> EXPORT IVD
          </button>
        </a>
        <!-- <a href="<?= base_url('export/transaction_ivd'."?date_start=$date_start&date_end=$date_end") ?>">
            <button class="btn btn-success btn-sm"><i class="fa fa-table"></i> EXPORT IVD</button>
        </a> -->
        <?php } ?>
        <a href="<?= base_url('transaction/export'."?date_start=$date_start&date_end=$date_end") ?>">
        <button type="button" class="btn btn-success btn-sm">
            <i class="fa fa-table"></i> EXPORT EXCEL
        </button>
        </a>
        <a href="<?= base_url('export/image'."?date_start=$date_start&date_end=$date_end") ?>">
        <button type="button" class="btn btn-success btn-sm">
            <i class="fa fa-table"></i> EXPORT .JPEG
        </button>
        </a>
    </div>
</div>
<hr>
<form action="">
<div class="row">
    <div class="col-md-3">
        <label for="">Tanggal Awal</label>
        <input type="date" class="form-control" name="date_start" value="<?= $date_start ?>">
    </div>
    <div class="col-md-3">
        <label for="">Tanggal Akhir</label>
        <input type="date" class="form-control" name="date_end" value="<?= $date_end ?>">
    </div>
    <div class="col-md-3">
        <label for="">&nbsp;</label><br>
        <button class="btn btn-primary">FILTER</button>
    </div>
</div>
</form>
<hr>
<div class="table-responsive">
<table class="table table-bordered table-stripped" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>No</th>    
        <!-- <th>Faktur Web</th>   -->
        <th>Booking</th>  
        <th>Tanggal</th>    
        <th>Toko</th>
        <th>Gudang</th>
        <th>Total QTY</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
        <?php 
        $no = 1;
        $total = 0;
        $rupiah = 0;
        foreach ($transcation as $dt) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <!-- <td><?= $dt['nofk_transaction'] ?></td> -->
                <td><?= $dt['nopofk'] ?></td>
                <td><?= $dt['date_transaction'] ?></td>
                <td><?= $dt['store_transaction'] ?></td>
                <td><?= $dt['warehouse_transaction'] ?></td>
                <td><?php 
                $sql = $this->db->query("SELECT SUM(qty_26_transdetail+qty_27_transdetail+qty_28_transdetail+qty_29_transdetail
                                  +qty_30_transdetail+qty_31_transdetail+qty_32_transdetail+qty_33_transdetail
                                  +qty_34_transdetail+qty_35_transdetail+qty_36_transdetail+qty_37_transdetail
                                  +qty_38_transdetail+qty_39_transdetail+qty_40_transdetail+qty_41_transdetail
                                  +qty_42_transdetail+qty_43_transdetail+qty_44_transdetail+qty_45_transdetail) as total
                        FROM tb_transdetail WHERE transaction_transdetail='".$dt['id_transaction']."'");
                $td = $sql->row_array();
                                        
                echo $td['total']; 
                $total += $td['total'];
                $rupiah += $dt['total_transaction'];
                ?></td>
                <td><?= number_format($dt['total_transaction'],0,0,".") ?></td>
                <td><?= b_reference($dt['status_transaction'],"TRX") ?></td>
                <td>
                    <a href="<?= base_url('transaction/detail/'.$dt['id_transaction']); ?>"><button class="btn btn-default btn-sm"><i class="fa fa-eye"></i></button></a>
                    <?php if(getLevel() == "admin")
                    {
                        ?><a href="<?= base_url('transaction/edit/'.$dt['id_transaction']); ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a><?php 
                    } ?>
                    <a href="<?= base_url('transaction/delete/'.$dt['id_transaction']); ?>" onclick="return confirm('yakin ingin menghapus data ini?')"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                </td>
            </tr>
        <?php } ?>

        <tfoot>
            <td colspan="5">Total</td>
            <td><?= number_format($total,0,0,".") ?></td>
            <td><?= number_format($rupiah,0,0,".") ?></td>
            <td></td>
            <td></td>
        </tfoot>
    </tbody>
</table>
</div>

<div class="modal fade" id="ivhModal" tabindex="-1" role="dialog" aria-labelledby="ivhModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export IVH</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
            <button type="button" class="btn btn-primary btn-export-ivh">PROSES</button>
            <a href="#" download="ivh.dbf" class="button-download-ivh" style="display: none;">
                <button type="button" class="btn btn-primary">UNDUH IVH</button>
            </a>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ivdModal" tabindex="-1" role="dialog" aria-labelledby="ivdModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export IVD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
            <button type="button" class="btn btn-primary btn-export-ivd">PROSES</button>
            <a href="#" download="ivd.dbf" class="button-download-ivd" style="display: none;">
                <button type="button" class="btn btn-primary">UNDUH IVD</button>
            </a>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ivsModal" tabindex="-1" role="dialog" aria-labelledby="ivsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export IVS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
            <button type="button" class="btn btn-primary btn-export-ivs">PROSES</button>
            <a href="#" download="ivs.dbf" class="button-download-ivs" style="display: none;">
                <button type="button" class="btn btn-primary">UNDUH IVS</button>
            </a>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $('.btn-export-ivh').on('click',function () {
        $.ajax({
            url:"<?=base_url('export/transaction_ivh')?>",
            type:"POST",
            data : {},
            beforeSend: function ( xhr ) {
                $(".btn-export-ivh").html("Loading..");
            },
            success:function (response) {
                var obj = jQuery.parseJSON(response);
                $(".btn-export-ivh").hide();
                $(".button-download-ivh").show();
                $(".button-download-ivh").attr("href", obj.link);
            }
        });
    });

    $('.btn-export-ivs').on('click',function () {
        $.ajax({
            url:"<?=base_url('export/transaction_ivs')?>",
            type:"POST",
            data : {},
            beforeSend: function ( xhr ) {
                $(".btn-export-ivs").html("Loading..");
            },
            success:function (response) {
                var obj = jQuery.parseJSON(response);
                $(".btn-export-ivs").hide();
                $(".button-download-ivs").show();
                $(".button-download-ivs").attr("href", obj.link);
            }
        });
    });

    $('.btn-export-ivd').on('click',function () {
        $.ajax({
            url:"<?=base_url('export/transaction_ivd')?>",
            type:"POST",
            data : {},
            beforeSend: function ( xhr ) {
                $(".btn-export-ivd").html("Loading..");
            },
            success:function (response) {
                var obj = jQuery.parseJSON(response);
                $(".btn-export-ivd").hide();
                $(".button-download-ivd").show();
                $(".button-download-ivd").attr("href", obj.link);
            }
        });
    });
});

</script>