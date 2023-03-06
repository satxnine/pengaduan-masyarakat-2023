<?php
	function notifikasi($teks, $halamanTujuan){
		return "<script>alert('$teks');window.location='$halamanTujuan'</script>";
	}
?>