<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="utf-8">
	<title>Tes Transcon Indonesia - Mochammad Danny Setyawan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="google-site-verification" content=""/>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index,follow"/>
	<meta name="copyright" content="This website has been registered and trademark of MDSPRO "/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url('css/owl.carousel.css');?>" type="text/css">
</head>
<body>
<div class="modal fade" id="transaction" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <form class="input-transaction" method="post" autocomplete="off" id="formTransaction" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-20">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal_title"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group mb-3 col-md-6 col-xs-12">
                            <label class="d-block mb-0">Transaction No <sup class="font-weight-bold text-danger">(*)</sup></label>
                            <input type="number" name="t_no" id="t_no" class="form-control rounded-0">
                        </div>
                        <div class="form-group mb-3 col-md-6 col-xs-12">
                            <label class="d-block mb-0">Transaction Date <sup class="font-weight-bold text-danger">(*)</sup></label>
                            <input type="date" name="t_date" id="t_date" class="form-control rounded-0">
                        </div>
						<div class="form-group mb-3 col-md-12 col-xs-12">
							<div class="form-row" style="margin-bottom:10px;">
								<div class="col-md-12 col-xs-12">
									<h6 class="font-weight-bold">Detail Items</h6>
								</div>
								<div class="form-group col-md-6 col-xs-6 mb-0">
									<label class="d-block mb-0">Item Name <sup class="font-weight-bold text-danger">(*)</sup></label>
								</div>
								<div class="form-group col-md-6 col-xs-6 mb-0">
									<label class="d-block mb-0">Quantity <sup class="font-weight-bold text-danger">(*)</sup></label>
								</div>
							</div> 
							<div class="cloneitem"></div>
						</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <input type="hidden" name="id" id="id_data">
                        <button type="submit" class="float-right ml-1 btn btn-success btnaddopsi">Simpan</button>
                        <button type="button" class="btn btn-secondary rounded-0 mr-0 float-right" data-dismiss="modal"><i class="fa fa-ban"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="container">
	<h1>PT. Transcon Indonesia - Programming Test</h1>
	<h4 style="margin-bottom:30px;">Nama : Mochammad Danny Setyawan</h4>
	<button class="btn btn-success" onclick="tambah();" style="margin-bottom:10px;">Tambah Data</button>
	<table id="table_tansaction" class="table table-striped table-hover table-bordered table-default" cellspacing="0" width="100%" style="box-shadow:0px 0px 8px 0px #bababa;">
            <thead>
                <tr>
                    <th style="text-align:center;">No</th>
					<th style="text-align:center;">Transaksi</th>
					<th style="text-align:center;">Total Item</th>
					<th style="text-align:center;">Total Quantity</th>
					<th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
					if(count($get_list) == 0){
				?>
					<tr>
					<td style="text-align:center;" colspan="5">No Data Found</td>
					</tr>
				<?php 
					}else{
					$no = 0;
					foreach($get_list as $data){
					$no++;
					$total_item = $this->db->from('transaction_details')->where('transaction_id',$data->id)->get()->result();
					$total_qty = 0;
					foreach($total_item as $p){
						$total_qty += $p->quantity;
					}
                ?>
               <tr>
                  <td style="text-align:center;"><?php echo $no;?></td>
                  <td style="text-align:center;"><?php echo $data->no_transaction;?></td>
				  <td style="text-align:center;"><?php echo count($total_item);?></td>
				  <td style="text-align:center;"><?php echo $total_qty;?></td>
                  <td style="text-align:center;">
                    <a style="margin-right: 10px;" href="javascript:void(0);" onclick="action(this)" data-type="edit" data-id="<?php echo $data->id?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
					<a style="margin-right: 10px;" href="javascript:void(0);" onclick="action(this)" data-type="hapus" data-id="<?php echo $data->id?>" class="btn btn-danger hapus" ><i class="fa fa-trash"></i></a>
					<a style="margin-right: 10px;" href="javascript:void(0);" onclick="action(this)" data-type="view" data-id="<?php echo $data->id?>" class="btn btn-default edit"><i class="fa fa-eye"></i></a>
                  </td>
              </tr>
             <?php }}?>
            </tbody>
  	</table>
	<p class="footer" style="padding:15px;">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
</body>
<script src="<?php echo base_url('js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.12.4.js')?>"></script>
<script src="<?php echo base_url('js/jquery-3.4.1.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('js/sweetalert.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery-cloneya.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready( function () {
		// $("#table_tansaction").DataTable();
		$("#formTransaction").on('submit',function(e){
			e.preventDefault();
			if($("#t_no").val() == ""){
				$("#t_no").focus();
				Swal.fire({
					icon: 'warning',
					title: 'Cek Kembali',
					text: "Nomor Transaksi Belum Disii",
					timer : 3000
				});
				return false;
			}

			if($("#t_date").val() == ""){
				$("#t_date").focus();
				Swal.fire({
					icon: 'warning',
					title: 'Cek Kembali',
					text: "Tanggal Transaksi Belum Diisi",
					timer : 3000
				});
				return false;
			}

			$.ajax({
				url      : "<?php echo base_url('Welcome/addItem')?>",
				type     : "POST",
				data	 : $(this).serialize(),
				beforeSend : function(){
					Swal.showLoading();
				},
				success : function(res){
					Swal.close();
					if(res.code == 200){
						$('#transaction').modal('hide');
						Swal.fire({
							title: "Success",
							text: res.description,
							icon: "success",
							timer:3000,
						});
						window.location.reload();
					}else{
						Swal.fire({
							title: "Error",
							text: res.description,
							icon: "error",
							timer:3000,
						});
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					Swal.fire({
						title: "Error",
						text: 'Gagal Memproses Data, Silahkan Periksa Koneksi Internet Anda Atau Coba Login Kembali',
						icon: "error",
						timer:3000,
					});
				}
			});  
		});
	});
	$('.cloneitem').cloneya();
	function tambah(){
		document.getElementById("formTransaction").reset();
		$("#modal_title").html('Tambah Item');
		$("#transaction").modal('show');
		$(".cloneitem").html('<div class="toclone"><a href="javascript:void(0);" class="bagde badge-success clone" style="padding:2px 10px;margin-right:5px;"><i style="font-size:10px" class="fa fa-plus"></i></a><a href="javascript:void(0);" class="bagde badge-danger delete"  style="padding:2px 10px"><i style="font-size:10px" class="fa fa-trash"></i></a><br><div class="form-row" style="margin-top: 15px;"><div class="form-group col-md-6 col-xs-6"><input type="text" name="item_name[]" class="form-control"></div><div class="form-group col-md-6 col-xs-6"><input type="number" name="qty[]" class="form-control"></div></div></div>');
	}

	function action(w){
		var act = $(w).attr('data-type');
		var id = $(w).attr('data-id');
		$.ajax({
				url      : "<?php echo base_url('Welcome/getordeleteItem')?>",
				type     : "GET",
				data	 : {act:act,id:id},
				beforeSend : function(){
					Swal.showLoading();
				},
				success : function(res){
					Swal.close();
					$('#transaction').modal('hide');
					if(act == "hapus"){
						Swal.fire({
							title: "Success",
							text: 'Data Berhasil Dihapus',
							icon: "success",
							timer:3000,
						}).then((result) => {
							if(result.value){
								window.location.reload();
							}
						})
					}else{
						if(act == "view"){
							$(".btnaddopsi").hide();
						}else{
							$(".btnaddopsi").show();
						}
						$("#modal_title").html('Detail Item');
						$("#t_no").val(res.data.no_transaction);
						$("#t_date").val(res.data.transaction_date);
						$("#id_data").val(res.data.id);
						$(".cloneitem").html(res.listItem);
						$("#transaction").modal('show');
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					Swal.fire({
						title: "Error",
						text: 'Gagal Memproses Data, Silahkan Periksa Koneksi Internet Anda Atau Coba Login Kembali',
						icon: "error",
						timer:3000,
					});
				}
			});  
	}

</script>
</html>
