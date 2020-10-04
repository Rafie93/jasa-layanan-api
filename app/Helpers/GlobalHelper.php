<?php
use Carbon\Carbon;

function options($src, $id, $ref_val, $text_field)
{
	$options = '';
	foreach ($src as $row) {
		$opt_value	= $row->$id;
		$text_value	= $row->$text_field;
		if (trim($row->$id) == trim($ref_val)) {
			$options .= '<option value="'.$opt_value.'" selected>'.$text_value.'</option>';
		}
		else {
			$options .= '<option value="'.$opt_value.'">'.$text_value.'</option>';
		}
	}
	return $options;
}
function options_or($src, $id, $ref_val, $text_field,$text_field2)
{
	$options = '';
	foreach ($src as $row) {
		$opt_value	= $row->$id;
		$text_value	= $row->$text_field;
		$text_value2 = $row->$text_field2;
		if (trim($row->$id) == trim($ref_val)) {
			$options .= '<option value="'.$opt_value.'" selected>'.$text_value.' | '.$text_value2.'</option>';
		}
		else {
			$options .= '<option value="'.$opt_value.'">'.$text_value.' | '.$text_value2.'</option>';
		}
	}
	return $options;
}
function ganti_format_tgl($tgl = "")
{
	$tanggal = explode("-", $tgl);
	$tgl = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	return $tgl;
}

function ganti_format_tgl_indo($tgl = "")
{
	$tanggal = explode("-", $tgl);
	$tgl = $tanggal[2]." ".char_to_month($tanggal[1])." ".$tanggal[0];
	return $tgl;
}

function char_to_month($month)
{
	switch ($month)
	{
		case "01" : return "January";
		case "02" : return "February";
		case "03" : return "March";
		case "04" : return "April";
		case "05" : return "Mei";
		case "06" : return "June";
		case "07" : return "July";
		case "08" : return "August";
		case "09" : return "September";
		case "10" : return "October";
		case "11" : return "November";
		case "12" : return "December";

		default : return FALSE;
	}
}

function strip_dot($text)
{
	return str_replace('.', '', $text);
}

function strip_comma($text)
{
	return str_replace(',', '', $text);
}

function to_number($str)
{
	return (float)str_replace(',', '.', str_replace('.', '', $str));
}

function currency($number)
{
	return '<div style="text-align:right;">'.number_format($number, 0, ',', '.').'</div>';
}

function formatRupiah($angka)
{
	return '<div style="text-align:right;">'.'Rp. '.number_format($angka,0,',','.').',00'.'</div>';
}

function decimal($number)
{
	return number_format($number, 2, ',', '.');
}

function percent($number)
{
	return decimal($number).' %';
}
function char_to_bulan($month)
{
	switch ($month)
	{
		case "01" : return "Januari";
		case "02" : return "Februari";
		case "03" : return "Maret";
		case "04" : return "April";
		case "05" : return "Mei";
		case "06" : return "Juni";
		case "07" : return "Juli";
		case "08" : return "Agustus";
		case "09" : return "September";
		case "10" : return "Oktober";
		case "11" : return "Nopember";
		case "12" : return "Desember";

		default : return FALSE;
	}
}

function num_to_daymonthyear($num)
{
	$ex = explode("-", $num);
	if(count($ex) == 3){
		$num = $ex[1];
	}else if(count($ex) == 2){
		$num = $ex[0];
	}

	switch ($num)
	{
		case  1	: $num = "Januari";break;
		case  2	: $num = "Februari";break;
		case  3	: $num = "Maret";break;
		case  4	: $num = "April";break;
		case  5	: $num = "Mei";break;
		case  6	: $num = "Juni";break;
		case  7	: $num = "Juli";break;
		case  8	: $num = "Agustus";break;
		case  9	: $num = "September";break;
		case 10	: $num = "Oktober";break;
		case 11	: $num = "November";break;
		case 12	: $num = "Desember";break;
	}
	if(count($ex) == 3){
		$num = $ex[0]." ".$num." ".$ex[2];
	}else if(count($ex) == 2){
		$num = $num." ".$ex[1];
	}

	return $num;
}

function datetime_to_char($date){
	if ($date == '') return '';
	$date_arr = explode(' ', $date);

	$new_date = num_to_daymonthyear(ganti_format_tgl($date_arr[0]));
	return $new_date;
}
function alert_warning($pesan=null)
{
	if ($pesan==null) {
		$pesan = 'Gagal Menyimpan data cek kolumn isian data';
	}
	return '<div class="alert alert-warning alert-dismissible" role="alert">
						  <strong>Perhatian !!</strong> '.$pesan.'
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>';
}
function alert_info($pesan=null)
{
	if ($pesan==null) {
		$pesan = 'Gagal Menyimpan data cek kolumn isian data';
	}
	return '<div class="alert alert-info alert-dismissible" role="alert">
						  <strong>Informasi : </strong> '.$pesan.'
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>';
}
 function addModal($action,$items=array(),$image=false)
{
	$enctype="";
	if ($image==true) {
		$enctype ='enctype="multipart/form-data"';
	}

	$isi = 	'
	  <div class="modal-dialog">

	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Tambah Data </h4>
	      </div>
	      <div class="modal-body">
	      	<form action="'.$action.'" method="post" '.$enctype.' >
	      		'.csrf_field().'';

	$jumlah_field = count($items);

	$array = array_values($items);
	$array_key = array_keys($items);

	// print_r($items);

	for ($i=0; $i <$jumlah_field ; $i++) {
		$title = strtoupper(str_replace('_', ' ', $array_key[$i]));
		if ($array[$i]=='text') {
			$isi .=' <div class="form-group">
				    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
				    <input type="text" class="form-control" id="'.$array_key[$i].'" name="'.$array_key[$i].'" placeholder="Masukkan '.$array_key[$i].' " value="'.old($array_key[$i]).'">


				  </div>';
		}else if ($array[$i]=='text_number') {
			$isi .=' <div class="form-group">
				    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
				    <input  onkeypress="return isNumberKey(event)" type="text" class="form-control" id="'.$array_key[$i].'" name="'.$array_key[$i].'" placeholder="Masukkan '.$array_key[$i].' " value="'.old($array_key[$i]).'">


				  </div>';
		}else if ($array[$i]=='tanggal') {
			$isi .=' <div class="form-group">
				    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
				    <input type="text" class="form-control tanggal" id="'.$array_key[$i].'" name="'.$array_key[$i].'" placeholder="yyyy-mm-dd" value="'.old($array_key[$i]).'">


				  </div>';
		}else if ($array[$i]=='email') {
			$isi .=' <div class="form-group">
				    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
				    <input type="email" class="form-control" id="'.$array_key[$i].'" name="'.$array_key[$i].'" placeholder="Masukkan '.$array_key[$i].' " value="'.old($array_key[$i]).'">


				  </div>';
		}else if ($array[$i]=='textarea') {
			$isi .=' <div class="form-group">
				    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
				    <textarea class="form-control " id="editor" name="'.$array_key[$i].'" rows="3">'.old($array_key[$i]).'</textarea>
				  </div>';
		}else if ($array[$i]=='image') {
			$isi .=' <div class="form-group">
				    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
				     <input type="file" class="form-control" id="'.$array_key[$i].'" name="'.$array_key[$i].'" value="'.old($array_key[$i]).'">
				  </div>';
		}
		else {
			$array_dua = array_values($array[$i]);
			$array_dua_key = array_keys($array_dua);
			$array_dalam = $array[$i];
			$array_values_dalam = array_keys($array_dalam);
			$tipe_array = $array_values_dalam[0];
			if ($tipe_array == 'option') {
				$isi .=' <div class="form-group">
				    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
					 <select class="form-control" id="'.$array_key[$i].'" name="'.$array_key[$i].'">';

				$array_tiga = array_values($array_dua[0]);

				for ($iii=0; $iii < count($array_dua[0]) ; $iii++) {
					 $isi.=   ' <option value="'.$array_tiga[$iii].'">'.$array_tiga[$iii].'</option>';
				}

				$isi.= '</select></div>';

			}else if ($tipe_array == 'option_db') {
			 	$isi .=' <div class="form-group">
			 	    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
			 		 <select class="form-control select2" id="'.$array_key[$i].'" name="'.$array_key[$i].'">';

			 	$array_tiga = array_values($array_dua[0]);
			 	$id_column = $array_tiga[1];
			 	$nama_column = $array_tiga[2];
			 	$ref_val = $array_tiga[3];
				foreach ($array_tiga[0] as $row) {
					if ($row->id_column == $row->ref_val) {
						$isi.=   ' <option value="'.$row->$id_column.'" selected>'.$row->$nama_column.'</option>';
					}else{
						$isi.=   ' <option value="'.$row->$id_column.'">'.$row->$nama_column.'</option>';
					}
				}

				$isi.= '</select></div>';
			}else if ($tipe_array == 'option_db_or') {
			 	$isi .=' <div class="form-group">
			 	    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
			 		 <select class="form-control select2" id="'.$array_key[$i].'" name="'.$array_key[$i].'">';

			 	$array_tiga = array_values($array_dua[0]);
			 	$id_column = $array_tiga[1];
			 	$nama_column = $array_tiga[2];
			 	$nama_column2 = $array_tiga[3];
			 	$ref_val = $array_tiga[4];
				foreach ($array_tiga[0] as $row) {
					if ($row->id_column == $row->ref_val) {
						$isi.= ' <option value="'.$row->$id_column.'" selected>'.$row->$nama_column.' | '.$row->$nama_column2. '</option>';
					}else{
						$isi.= ' <option value="'.$row->$id_column.'">'.$row->$nama_column.' | '.$row->$nama_column2. '</option>';
					}
				}

				$isi.= '</select></div>';
			}else if ($tipe_array == 'optiondb_custom') {
				$isi .=' <div class="form-group">
			 	    <label for="exampleFormControlInput'.$i.'">'.$title.'</label>
					  <select class="form-control select2" id="'.$array_key[$i].'" name="'.$array_key[$i].'">';
				$isi.= ' <option value="">--Kosongkan jika belum menentukan pilihan--</option>';

			 	$array_tiga = array_values($array_dua[0]);
			 	$id_column = $array_tiga[1];
			 	$nama_column = $array_tiga[2];
			 	$nama_column2 = $array_tiga[3];
			 	$ref_val = $array_tiga[4];
				foreach ($array_tiga[0] as $row) {
					if ($row->id_column == $row->ref_val) {
						$isi.= ' <option value="'.$row->$id_column.'" selected>'.$row->$nama_column.' | '.$row->$nama_column2. '</option>';
					}else{
						$isi.= ' <option value="'.$row->$id_column.'">'.$row->$nama_column.' | '.$row->$nama_column2. '</option>';
					}
				}

				$isi.= '</select></div>';
		   }else if ($tipe_array == 'radiocheck') {
				# code...
			}


		}
	}


	 $isi .='  <div class="modal-footer">
	      	<input type="submit" name="submit" value="Simpan" class="btn btn-success">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	      </form>
	      </div>


	    </div>

	  </div>
	';

	return $isi;
}



?>
