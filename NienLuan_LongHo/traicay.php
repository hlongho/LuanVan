<?php

	$ham = $_POST["ham"];
	// $ham = $_GET["ham"];

	switch ($ham) {
		case 'LayDanhSachMenu':
			$ham();
			break;
		case 'DangKy':
			$ham();
			break;
		case 'LayThongTinNguoiDung':
			$ham();
			break;
		case 'ThayDoiThongTinNguoiDung':
			$ham();
			break;
		case 'DoiMatKhauNguoiDung':
			$ham();
			break;
		case 'KiemTraDangNhap':
			$ham();
			break;
		case 'LayDanhSachLoaiTraiCay':
			$ham();
			break;
		case 'LayDanhSachQuocGia':
			$ham();
			break;
		case 'LayDanhSachDangKhuyenMai':
			$ham();
			break;
		case 'LayDanhSachSapKhuyenMai':
			$ham();
			break;
		case 'LayDanhSachTop10KhuyenMai':
			$ham();
			break;
		case 'LayDanhSachTraiCayKhuyenMai':
			$ham();
			break;
		case 'LayDanhSachTopTraiCayTheoLuotMua':
			$ham();
			break;
		case 'LayDanhSachTraiCayGiaRe':
			$ham();
			break;
		case 'LayDanhSachTraiCayNgauNhien':
			$ham();
			break;
		case 'LayDanhSachTraiCayTheoMaLoai':
			$ham();
			break;
		case 'LayDanhSachTraiCayTheoQuocGia':
			$ham();
			break;
		case 'LayDanhSachTraiCayKhuyenMaiTheoMa':
			$ham();
			break;
		case 'LayChiTietTraiCayTheoMa':
			$ham();
			break;
		case 'ThemDanhGia':
			$ham();
			break;
		case 'LayDanhSachDanhGiaTheoMaTraiCay':
			$ham();
			break;
		case 'ThemDonDatHang':
			$ham();
			break;
		case 'LayDanhSachDonDatHangTheoMaND':
			$ham();
			break;
		case 'TimKiemSanPhamTheoTenSP':
			$ham();
			break;
		case 'AdminLayDanhSachDonDatHang':
			$ham();
			break;
		case 'AdminDuyetDonHang':
			$ham();
			break;
		case 'AdminGiaoDonHang':
			$ham();
			break;
		case 'LayDanhSachDonDatHangTheoNam':
			$ham();
			break;
	}


	function KiemTraDangNhap(){
		include_once("config.php");

		$EmailND = $_POST["EmailND"];
		$MatKhau = $_POST["MatKhau"];

		$truyvan = "SELECT * FROM nguoidung nd, quyentruycap qtc WHERE nd.MaQuyen = qtc.MaQuyen AND nd.EmailND = '".$EmailND."' AND nd.MatKhau = '".$MatKhau."' ";
		$ketqua = (mysqli_query($conn,$truyvan));
		$demdong = mysqli_num_rows($ketqua);
		if($demdong>=1){
			$TenNguoiDung="";
			while ($dong = mysqli_fetch_array($ketqua)) {
				$TenNguoiDung = $dong["TenNguoiDung"];
				$MaNguoiDung = $dong["MaNguoiDung"];
				$TenQuyen = $dong["TenQuyen"];
			}
			echo "{\"ketqua\":\"true\",\"TenNguoiDung\":\"".$TenNguoiDung."\",\"MaNguoiDung\":\"".$MaNguoiDung."\",\"TenQuyen\":\"".$TenQuyen."\"}";
		}
		else {
			echo "{\"ketqua\":\"false\"}";
		}
	}

	function DangKy(){
    	include_once("config.php");

		$TenNguoiDung = $_POST["TenNguoiDung"];
		$DiaChiND = $_POST["DiaChiND"];
		$SoDienThoaiND = $_POST["SoDienThoaiND"];
		$EmailND = $_POST["EmailND"];
		$GioiTinh = $_POST["GioiTinh"];
		$MatKhau = $_POST["MatKhau"];
		// $CauHoi = $_POST["CauHoi"];
		// $CauTraLoi = $_POST["CauTraLoi"];
		$MaQuyen = $_POST["MaQuyen"];
		$truyvan = "INSERT INTO nguoidung (TenNguoiDung, DiaChiND, SoDienThoaiND, EmailND, GioiTinh,MatKhau, MaQuyen) VALUES ('".$TenNguoiDung."', '".$DiaChiND."', '".$SoDienThoaiND."', '".$EmailND."', '".$GioiTinh."', '".$MatKhau."', '".$MaQuyen."')";
		if(mysqli_query($conn,$truyvan)){
			echo "{\"ketqua\":\"true\"}";
		}
		else echo "{\"ketqua\":\"false\"}";
		mysql_close($conn);
	}
	function LayThongTinNguoiDung()
	{
		include_once("config.php");
		if(isset($_POST["MaNguoiDung"])){
			$MaNguoiDung = $_POST["MaNguoiDung"];
			$truyvan = "SELECT * FROM nguoidung WHERE MaNguoiDung = '".$MaNguoiDung."'";
		}
		if(isset($_POST["EmailND"])){
			$EmailND = $_POST["EmailND"];
			$truyvan = "SELECT * FROM nguoidung WHERE EmailND like '".$EmailND."'";
		}
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		// array_push($chuoijson, array('MaLTC' => $dong["MaLTC"],'TenLTC' => $dong["TenLTC"],'HinhLTC' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/LoaiTraiCay/".$dong["HinhLTC"] ));//in theo nhu cầu
		 		$chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"nguoidung\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function ThayDoiThongTinNguoiDung(){
    	include_once("config.php");
    	$MaNguoiDung = $_POST["MaNguoiDung"];
		$TenNguoiDung = $_POST["TenNguoiDung"];
		$DiaChiND = $_POST["DiaChiND"];
		$SoDienThoaiND = $_POST["SoDienThoaiND"];
		$EmailND = $_POST["EmailND"];
		$GioiTinh = $_POST["GioiTinh"];
		$MatKhau = $_POST["MatKhau"];
		// $CauHoi = $_POST["CauHoi"];
		// $CauTraLoi = $_POST["CauTraLoi"];

		// $MaNguoiDung = $_GET["MaNguoiDung"];
		// $TenNguoiDung = $_GET["TenNguoiDung"];
		// $DiaChiND = $_GET["DiaChiND"];
		// $SoDienThoaiND = $_GET["SoDienThoaiND"];
		// $EmailND = $_GET["EmailND"];
		// $GioiTinh = $_GET["GioiTinh"];
		// $MatKhau = $_GET["MatKhau"];
		// $CauHoi = $_GET["CauHoi"];
		// $CauTraLoi = $_GET["CauTraLoi"];

		$truyvan = "UPDATE nguoidung SET TenNguoiDung = '".$TenNguoiDung."', DiaChiND = '".$DiaChiND."', SoDienThoaiND = '".$SoDienThoaiND."', EmailND = '".$EmailND."', GioiTinh = '".$GioiTinh."', MatKhau = '".$MatKhau."' WHERE MaNguoiDung = '".$MaNguoiDung."'";
		if(mysqli_query($conn,$truyvan)){
			echo "{\"ketqua\":\"true\"}";
		}
		else echo "{\"ketqua\":\"false\"}";
	}
	function DoiMatKhauNguoiDung(){
    	include_once("config.php");
    	$MaNguoiDung = $_POST["MaNguoiDung"];
		$MatKhau = $_POST["MatKhau"];

		// $MaNguoiDung = $_GET["MaNguoiDung"];
		// $MatKhau = $_GET["MatKhau"];

		$truyvan = "UPDATE nguoidung SET MatKhau = '".$MatKhau."' WHERE MaNguoiDung = '".$MaNguoiDung."'";
		if(mysqli_query($conn,$truyvan)){
			echo "{\"ketqua\":\"true\"}";
		}
		else echo "{\"ketqua\":\"false\"}";
	}
	function LayDanhSachMenu()
	{
		include_once("config.php");
		$MaLTC = $_POST["MaLTC"];

		$truyvan = "SELECT * FROM loaitraicay join traicay on loaitraicay.MaLTC = traicay.MaLTC where loaitraicay.MaLTC=".$MaLTC;
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		/*echo $dong["TenLTC"]."<br>";
		 		//in ra mảng theo cấu trúc bảng*/
		 		// array_push($chuoijson, array('MaLTC' => $dong["MaLTC"],'TenLTC' => $dong["TenLTC"] ));//in theo nhu cầu
		 		$chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"loaitraicay\":";
		 	echo json_encode($chuoijson);
		 	echo "";
		 	echo "}";
	 	}
	 	mysql_close($conn);
	}

	function LayDanhSachLoaiTraiCay()
	{
		include_once("config.php");
		$truyvan = "SELECT * FROM loaitraicay ORDER BY TenLTC ASC";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		array_push($chuoijson, array('MaLTC' => $dong["MaLTC"],'TenLTC' => $dong["TenLTC"],'HinhLTC' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/LoaiTraiCay/".$dong["HinhLTC"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"loaitraicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayDanhSachQuocGia()
	{
		include_once("config.php");
		$truyvan = "SELECT * FROM quocgia";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		array_push($chuoijson, array('MaQG' => $dong["MaQG"],'TenQG' => $dong["TenQG"],'QuocKiQG' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/QuocGia/".$dong["QuocKiQG"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"quocgia\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayDanhSachDangKhuyenMai()
	{
		include_once("config.php");
		// $truyvan = "SELECT * FROM khuyenmai where (NgayBatDau <= Date(Now())) and (NgayKetThuc >= Date(Now()))";
		$truyvan = "SELECT * FROM khuyenmai where Date(Now()) between NgayBatDau and NgayKetThuc";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		array_push($chuoijson, array('MaKM' => $dong["MaKM"],'TenKM' => $dong["TenKM"],'NgayBatDau' => $dong["NgayBatDau"],'NgayKetThuc' => $dong["NgayKetThuc"],'HinhKM' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/KhuyenMai/".$dong["HinhKM"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"khuyenmai\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayDanhSachSapKhuyenMai()
	{
		include_once("config.php");
		$truyvan = "SELECT * FROM khuyenmai where NgayBatDau > Date(Now())";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		array_push($chuoijson, array('MaKM' => $dong["MaKM"],'TenKM' => $dong["TenKM"],'NgayBatDau' => $dong["NgayBatDau"],'NgayKetThuc' => $dong["NgayKetThuc"],'HinhKM' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/KhuyenMai/".$dong["HinhKM"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"khuyenmai\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayDanhSachTop10KhuyenMai()
	{
		include_once("config.php");
		$truyvan = "SELECT * FROM khuyenmai ORDER BY NgayBatDau DESC LIMIT 10";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		array_push($chuoijson, array('MaKM' => $dong["MaKM"],'TenKM' => $dong["TenKM"],'NgayBatDau' => $dong["NgayBatDau"],'NgayKetThuc' => $dong["NgayKetThuc"],'HinhKM' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/KhuyenMai/".$dong["HinhKM"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"khuyenmai\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}
	function LayDanhSachTraiCayKhuyenMai()
	{
		include_once("config.php");
		$truyvan = "SELECT * FROM khuyenmai km, chitietkhuyenmai ctkm, traicay tc WHERE (Date(Now()) between km.NgayBatDau and km.NgayKetThuc) AND (km.MaKM = ctkm.MaKM AND ctkm.MaTraiCay = tc.MaTraiCay)";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		array_push($chuoijson, array('MaTraiCay' => $dong["MaTraiCay"],'TenTraiCay' => $dong["TenTraiCay"],'GiaBan' => $dong["GiaBan"],'GiaKM' => $dong["GiaKM"],'LuotMua' => $dong["LuotMua"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"] ));
		 	}
		 	echo "{";
		 	echo "\"traicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}
	function LayDanhSachTopTraiCayTheoLuotMua()
	{
		include_once("config.php");
		$truyvan = "SELECT * FROM traicay ORDER BY LuotMua DESC";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		$truyvankhuyenmai = "SELECT * FROM khuyenmai km, chitietkhuyenmai ctkm WHERE (Date(Now()) between km.NgayBatDau and km.NgayKetThuc) AND km.MaKM = ctkm.MaKM AND  ctkm.MaTraiCay='".$dong["MaTraiCay"]."'";
				$ketquakhuyenmai = mysqli_query($conn,$truyvankhuyenmai);

				$GiaKM = 0;
				if($ketquakhuyenmai){
					while ($dongkhuyenmai = mysqli_fetch_array($ketquakhuyenmai)) {
						$GiaKM = $dongkhuyenmai["GiaKM"];
					}
				}
		 		array_push($chuoijson, array('MaTraiCay' => $dong["MaTraiCay"],'TenTraiCay' => $dong["TenTraiCay"],'GiaBan' => $dong["GiaBan"],'GiaKM' => $GiaKM,'LuotMua' => $dong["LuotMua"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"traicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayDanhSachTraiCayGiaRe()
	{
		include_once("config.php");
		$truyvan = "SELECT * FROM traicay ORDER BY GiaBan ASC";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		$truyvankhuyenmai = "SELECT * FROM khuyenmai km, chitietkhuyenmai ctkm WHERE (Date(Now()) between km.NgayBatDau and km.NgayKetThuc) AND km.MaKM = ctkm.MaKM AND  ctkm.MaTraiCay='".$dong["MaTraiCay"]."'";
				$ketquakhuyenmai = mysqli_query($conn,$truyvankhuyenmai);

				$GiaKM = 0;
				if($ketquakhuyenmai){
					while ($dongkhuyenmai = mysqli_fetch_array($ketquakhuyenmai)) {
						$GiaKM = $dongkhuyenmai["GiaKM"];
					}
				}
		 		array_push($chuoijson, array('MaTraiCay' => $dong["MaTraiCay"],'TenTraiCay' => $dong["TenTraiCay"],'GiaBan' => $dong["GiaBan"],'GiaKM' => $GiaKM,'LuotMua' => $dong["LuotMua"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"traicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayDanhSachTraiCayNgauNhien()
	{
		include_once("config.php");
		$truyvan = "SELECT * FROM traicay ORDER BY RAND()";
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		$truyvankhuyenmai = "SELECT * FROM khuyenmai km, chitietkhuyenmai ctkm WHERE (Date(Now()) between km.NgayBatDau and km.NgayKetThuc) AND km.MaKM = ctkm.MaKM AND  ctkm.MaTraiCay='".$dong["MaTraiCay"]."'";
				$ketquakhuyenmai = mysqli_query($conn,$truyvankhuyenmai);

				$GiaKM = 0;
				if($ketquakhuyenmai){
					while ($dongkhuyenmai = mysqli_fetch_array($ketquakhuyenmai)) {
						$GiaKM = $dongkhuyenmai["GiaKM"];
					}
				}
		 		array_push($chuoijson, array('MaTraiCay' => $dong["MaTraiCay"],'TenTraiCay' => $dong["TenTraiCay"],'GiaBan' => $dong["GiaBan"],'GiaKM' => $GiaKM,'LuotMua' => $dong["LuotMua"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"traicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayDanhSachTraiCayTheoMaLoai()
	{
		//cách test http://localhost/NienLuan_LongHo/traicay.php?ham=LayDanhSachTraiCayTheoMaLoai&maLTC=1
		include_once("config.php");
		$MaLTC = $_POST["maLTC"];
		$truyvan = "SELECT * FROM traicay WHERE MaLTC =".$MaLTC;
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		array_push($chuoijson, array('MaTraiCay' => $dong["MaTraiCay"],'TenTraiCay' => $dong["TenTraiCay"],'GiaBan' => $dong["GiaBan"],'LuotMua' => $dong["LuotMua"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"traicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayDanhSachTraiCayTheoQuocGia()
	{
		//cách test http://localhost/NienLuan_LongHo/traicay.php?ham=LayDanhSachTraiCayTheoMaLoai&maLTC=1
		include_once("config.php");
		$MaQG = $_POST["maqg"];
		$truyvan = "SELECT * FROM traicay WHERE MaQG =".$MaQG;
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		array_push($chuoijson, array('MaTraiCay' => $dong["MaTraiCay"],'TenTraiCay' => $dong["TenTraiCay"],'GiaBan' => $dong["GiaBan"],'LuotMua' => $dong["LuotMua"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"traicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}
	function LayDanhSachTraiCayKhuyenMaiTheoMa()
	{
		//cách test http://localhost/NienLuan_LongHo/traicay.php?ham=LayDanhSachTraiCayTheoMaLoai&maLTC=1
		include_once("config.php");
		$MaKM = $_POST["makm"];
		$truyvan = "SELECT * FROM chitietkhuyenmai ctkm join traicay tc on ctkm.MaTraiCay = tc.MaTraiCay  WHERE MaKM =".$MaKM;
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng
		 		array_push($chuoijson, array('MaTraiCay' => $dong["MaTraiCay"],'TenTraiCay' => $dong["TenTraiCay"],'GiaBan' => $dong["GiaBan"],'GiaKM' => $dong["GiaKM"],'LuotMua' => $dong["LuotMua"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"] ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"traicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function LayChiTietTraiCayTheoMa()
	{
		//cách test http://localhost/NienLuan_LongHo/traicay.php?ham=LayDanhSachTraiCayTheoMaLoai&maLTC=1
		include_once("config.php");
		$MaTraiCay = $_POST["matraicay"];
		$truyvan = "SELECT * FROM traicay tc,nhacungcap ncc WHERE MaTraiCay =".$MaTraiCay." AND tc.MaNCC = ncc.MaNCC" ;
		$ketqua = mysqli_query($conn, $truyvan);
		$chuoijson = array();
		if($ketqua){
			while($dong = mysqli_fetch_array($ketqua)){
		 		// echo $dong["TenLTC"]."<br>";
		 		// in ra mảng theo cấu trúc bảng

				$truyvankhuyenmai = "SELECT * FROM khuyenmai km, chitietkhuyenmai ctkm WHERE (Date(Now()) between km.NgayBatDau and km.NgayKetThuc) AND km.MaKM = ctkm.MaKM AND  ctkm.MaTraiCay='".$dong["MaTraiCay"]."'";
				$ketquakhuyenmai = mysqli_query($conn,$truyvankhuyenmai);

				$GiaKM = 0;
				if($ketquakhuyenmai){
					while ($dongkhuyenmai = mysqli_fetch_array($ketquakhuyenmai)) {
						$GiaKM = $dongkhuyenmai["GiaKM"];
					}
				}

		 		array_push($chuoijson, array('MaTraiCay' => $dong["MaTraiCay"],'MaLTC' => $dong["MaLTC"],'MaNCC' => $dong["MaNCC"],'MaQG' => $dong["MaQG"],'TenTraiCay' => $dong["TenTraiCay"],'GiaBan' => $dong["GiaBan"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"],'HinhChiTiet' => $dong["HinhChiTiet"],'MieuTaTC' => $dong["MieuTaTC"],'LuotMua' => $dong["LuotMua"],'ThanhPhanDinhDuong' => $dong["ThanhPhanDinhDuong"],'MoiTruongTrong' => $dong["MoiTruongTrong"],'SoLuongTon' => $dong["SoLuongTon"],'TenNCC' => $dong["TenNCC"],'DiaChiNCC' => $dong["DiaChiNCC"],'GiaKM' => $GiaKM ));//in theo nhu cầu
		 		// $chuoijson[]=$dong;//in ra toàn bộ bảng nhưng không đúng định dạng
		 	}
		 	echo "{";
		 	echo "\"traicay\":";
		 	echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		 	echo "";
		 	echo "}";
	 	}
	}

	function ThemDanhGia(){
		include_once("config.php");

		if(isset($_POST["madg"]) || isset($_POST["masp"]) || isset($_POST["tenthietbi"]) || isset($_POST["manguoidung"]) || isset($_POST["noidung"]) || isset($_POST["sosao"]) ){
			$madg = $_POST["madg"];
			$masp = $_POST["masp"];
			$tenthietbi = $_POST["tenthietbi"];
			$manguoidung = $_POST["manguoidung"];
			$noidung = $_POST["noidung"];
			$sosao = $_POST["sosao"];
		}

		$ngaydang = date("Y/m/d");
		// $ngaydang = Date(Now());

		$truyvan = "INSERT INTO danhgia (MaDG,MaTraiCay,TenThietBi,MaNguoiDung,NoiDungDG,SoSaoDG,NgayDG) VALUES ('".$madg."', '".$masp."', '".$tenthietbi."', '".$manguoidung."', '".$noidung."', '".$sosao."', '".$ngaydang."' )";
		$ketqua = mysqli_query($conn,$truyvan);

		if($ketqua){
			echo "{ketqua:true}";
		}else{
			echo "{ketqua:false}";
		}

	}

	function LayDanhSachDanhGiaTheoMaTraiCay(){
		include_once("config.php");
		$chuoijson = array();

		if(isset($_POST["masp"]) || isset($_POST["limit"]) ){
			$masp = $_POST["masp"];
			$limit = $_POST["limit"];
		}

		$truyvan = "SELECT * FROM danhgia dg, nguoidung nd WHERE dg.MaTraiCay = ".$masp." AND dg.MaNguoiDung = nd.MaNguoiDung ORDER BY dg.NgayDG DESC LIMIT ".$limit." ,10";
		$ketqua = mysqli_query($conn,$truyvan);

		echo "{";
		echo "\"DanhSachDanhGia\":";

		if($ketqua){
			while ($dong = mysqli_fetch_array($ketqua)) {
				$chuoijson[] = $dong;
			}
		}

		echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);

		echo "}";

	}

	function ThemDonDatHang(){
		include_once("config.php");

		if(isset($_POST["danhsachsanpham"]) || isset($_POST["manguoidung"]) || isset($_POST["tennguoinhan"]) || isset($_POST["sodt"]) || isset($_POST["diachi"]) || isset($_POST["mota"]) || isset($_POST["chuyenkhoan"]) ){
			$danhsachsanpham = $_POST["danhsachsanpham"];
			$manguoidung = $_POST["manguoidung"];
			$tennguoinhan = $_POST["tennguoinhan"];
			$sodt = $_POST["sodt"];
			$diachi = $_POST["diachi"];
			$mota = $_POST["mota"];
			$chuyenkhoan = $_POST["chuyenkhoan"];
		}

		$ngayhientai = date("Y/m/d");
		$ngaygiao = date_create($ngayhientai);
		$ngaygiao = date_modify($ngaygiao,"+3 days");
		$ngaygiao = date_format($ngaygiao,"Y/m/d") ;
		$trangthai = "Chờ kiểm duyệt";

		$truyvan = "INSERT INTO dondathang (MaNguoiDung,NgayDat,NgayGiao,TrangThaiGiao,TenNguoiDatHang,SoDienThoaiDatHang,DiaChiDatHang,MoTa,ChuyenKhoan) VALUES ('".$manguoidung."', '".$ngayhientai."', '".$ngaygiao."', '".$trangthai."', '".$tennguoinhan."', '".$sodt."', '".$diachi."', '".$mota."', '".$chuyenkhoan."')";
		$ketqua = mysqli_query($conn,$truyvan);

		if($ketqua){
			$mahd = mysqli_insert_id($conn);
			$chuoijsonandroid = json_decode($danhsachsanpham);
			$arrayDanhSachSanPham = $chuoijsonandroid->DANHSACHSANPHAM;
			$dem = count($arrayDanhSachSanPham);

			for($i=0; $i<$dem; $i++){
				$jsonObect = $arrayDanhSachSanPham[$i];

				$masp = $jsonObect->MaTraiCay;
				$soluong = $jsonObect->SoLuongDat;
				$GiaBanHD = $jsonObect->GiaBanHD;

				$truyvan = "INSERT INTO chitietddh (MaDDH,MaTraiCay,SoLuongDat,GiaBanHD) VALUES ('".$mahd."', '".$masp."', '".$soluong."', '".$GiaBanHD."')";
				$ketqua1 = mysqli_query($conn,$truyvan);


			}

			echo "{ketqua:true}" ;

		}else{
			echo "{ketqua:false}";
		}

	}
	function LayDanhSachDonDatHangTheoMaND(){
		include_once("config.php");
		$chuoijson = array();

		if(isset($_POST["manguoidung"])){
			$manguoidung = $_POST["manguoidung"];
		}

		// if(isset($_GET["manguoidung"])){
		// 	$manguoidung = $_GET["manguoidung"];
		// }

		$truyvan = "SELECT * FROM dondathang where MaNguoiDung = ".$manguoidung." ORDER BY MaDDH DESC";
		$ketqua = mysqli_query($conn,$truyvan);

		echo "{";
		echo "\"DanhSachDonDatHang\":";

		if($ketqua){
			while ($dong = mysqli_fetch_array($ketqua)) {

				$truyvanchitietddh = "SELECT * FROM chitietddh ctddh, traicay tc WHERE ctddh.MaDDH = '".$dong["MaDDH"]."' AND ctddh.MaTraiCay = tc.MaTraiCay";

				$ketquadondathang = mysqli_query($conn,$truyvanchitietddh);

				$chuoijsondanhsachsanpham = array();

				if($ketquadondathang){
					while ( $dongsanpham = mysqli_fetch_array($ketquadondathang) ) {
						$chuoijsondanhsachsanpham[] = $dongsanpham;
					}
				}

				array_push($chuoijson, array("MaDDH"=>$dong["MaDDH"],"MaNguoiDung"=>$dong["MaNguoiDung"],"TenNguoiDatHang"=>$dong["TenNguoiDatHang"],"SoDienThoaiDatHang"=>$dong["SoDienThoaiDatHang"],"DiaChiDatHang"=>$dong["DiaChiDatHang"],"NgayDat"=>$dong["NgayDat"],"NgayGiao"=>$dong["NgayGiao"],"TrangThaiGiao"=>$dong["TrangThaiGiao"],"MoTa"=>$dong["MoTa"],"DanhSachTraiCay"=>$chuoijsondanhsachsanpham));

			}
		}

		echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);

		echo "}";
	}
	function TimKiemSanPhamTheoTenSP(){
		include_once("config.php");
		$chuoijson = array();

		if(isset($_POST["TenTraiCay"])){
			$TenTraiCay = $_POST["TenTraiCay"];
		}

		$ngayhientai = date("Y/m/d");
		$truyvan = " SELECT *  FROM traicay WHERE TenTraiCay like '%".$TenTraiCay."%'";
		$ketqua = mysqli_query($conn,$truyvan);


		echo "{";
		echo "\"DanhSachTraiCay\":";

		if($ketqua){
			while ($dong = mysqli_fetch_array($ketqua)) {
				$truyvankhuyenmai = "SELECT * FROM khuyenmai km, chitietkhuyenmai ctkm WHERE (Date(Now()) between km.NgayBatDau and km.NgayKetThuc) AND km.MaKM = ctkm.MaKM AND  ctkm.MaTraiCay='".$dong["MaTraiCay"]."'";
				$ketquakhuyenmai = mysqli_query($conn,$truyvankhuyenmai);

				$GiaKM = 0;
				if($ketquakhuyenmai){
					while ($dongkhuyenmai = mysqli_fetch_array($ketquakhuyenmai)) {
						$GiaKM = $dongkhuyenmai["GiaKM"];
					}
				}

				array_push($chuoijson, array("MaTraiCay"=>$dong["MaTraiCay"], "TenTraiCay"=>$dong["TenTraiCay"], "LuotMua"=>$dong["LuotMua"], "GiaBan"=>$dong["GiaBan"],'HinhTraiCay' => "http://".$_SERVER['SERVER_NAME']."/NienLuan_LongHo"."/Image"."/TraiCay/".$dong["HinhTraiCay"], "GiaKM"=>$GiaKM));
			}
		}

		echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
		echo "}";
	}
	function AdminLayDanhSachDonDatHang(){
		include_once("config.php");
		$chuoijson = array();

		if(isset($_POST["ChuaDuyet"])){
			$truyvan = "SELECT * FROM dondathang where TrangThaiGiao = 'Chờ kiểm duyệt'";
		}
		if(isset($_POST["ChuaGiao"])){
			$truyvan = "SELECT * FROM dondathang where TrangThaiGiao = 'Đã duyệt'";
		}

		$ketqua = mysqli_query($conn,$truyvan);

		echo "{";
		echo "\"DanhSachDonDatHang\":";

		if($ketqua){
			while ($dong = mysqli_fetch_array($ketqua)) {

				$truyvanchitietddh = "SELECT * FROM chitietddh ctddh, traicay tc WHERE ctddh.MaDDH = '".$dong["MaDDH"]."' AND ctddh.MaTraiCay = tc.MaTraiCay";

				$ketquadondathang = mysqli_query($conn,$truyvanchitietddh);

				$chuoijsondanhsachsanpham = array();

				if($ketquadondathang){
					while ( $dongsanpham = mysqli_fetch_array($ketquadondathang) ) {
						$chuoijsondanhsachsanpham[] = $dongsanpham;
					}
				}

				array_push($chuoijson, array("MaDDH"=>$dong["MaDDH"],"MaNguoiDung"=>$dong["MaNguoiDung"],"TenNguoiDatHang"=>$dong["TenNguoiDatHang"],"SoDienThoaiDatHang"=>$dong["SoDienThoaiDatHang"],"DiaChiDatHang"=>$dong["DiaChiDatHang"],"NgayDat"=>$dong["NgayDat"],"NgayGiao"=>$dong["NgayGiao"],"TrangThaiGiao"=>$dong["TrangThaiGiao"],"MoTa"=>$dong["MoTa"],"DanhSachTraiCay"=>$chuoijsondanhsachsanpham));

			}
		}

		echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);

		echo "}";
	}
	function AdminDuyetDonHang(){
    	include_once("config.php");
    	$MaDDH = $_POST["MaDDH"];
    	$MaNguoiDuyet = $_POST["MaNguoiDuyet"];
    	$TrangThaiGiao = $_POST["TrangThaiGiao"];

		$truyvan = "UPDATE dondathang SET TrangThaiGiao = '".$TrangThaiGiao."', MaNguoiDuyet = '".$MaNguoiDuyet."' WHERE MaDDH = '".$MaDDH."'";
		if(mysqli_query($conn,$truyvan)){
			echo "{\"ketqua\":\"true\"}";
		}
		else echo "{\"ketqua\":\"false\"}";
	}

	function AdminGiaoDonHang(){
    	include_once("config.php");
    	$MaDDH = $_POST["MaDDH"];
    	$MaNguoiGiao = $_POST["MaNguoiGiao"];
    	$TrangThaiGiao = $_POST["TrangThaiGiao"];

		$truyvan = "UPDATE dondathang SET TrangThaiGiao = '".$TrangThaiGiao."', MaNguoiGiao = '".$MaNguoiGiao."' WHERE MaDDH = '".$MaDDH."'";
		if(mysqli_query($conn,$truyvan)){
			echo "{\"ketqua\":\"true\"}";
		}
		else echo "{\"ketqua\":\"false\"}";
	}

	function LayDanhSachDonDatHangTheoNam(){
		include_once("config.php");
		$chuoijson = array();

		$truyvan = "SELECT YEAR(NgayGiao) AS Nam, COUNT(MaDDH) SoLuongDDH FROM dondathang GROUP BY YEAR(NgayGiao)";
		$ketqua = mysqli_query($conn,$truyvan);

		echo "{";
		echo "\"DanhSachThongKeTheoNam\":";

		if($ketqua){
			while ($dong = mysqli_fetch_array($ketqua)) {

				$truyvantrangthaigiao = "SELECT TrangThaiGiao, COUNT(MaDDH) SoLuongDonHang FROM dondathang WHERE YEAR(NgayGiao) =' ".$dong["Nam"]." '  GROUP BY TrangThaiGiao";
				$ketquatrangthaigiao = mysqli_query($conn,$truyvantrangthaigiao);
				$chuoijsontrangthai = array();
				if($ketquatrangthaigiao){
					while ( $dongtrangthai = mysqli_fetch_array($ketquatrangthaigiao) ) {
						array_push($chuoijsontrangthai,array("TrangThaiGiao"=>$dongtrangthai["TrangThaiGiao"],"SoLuongDonHang"=>$dongtrangthai["SoLuongDonHang"]));
					}
				}

				$truyvantraicay = "SELECT tc.MaTraiCay, tc.TenTraiCay, SUM(ct.SoLuongDat) SoLuongBan, SUM(ct.SoLuongDat*ct.GiaBanHD) SoTienBan,tc.HinhTraiCay FROM dondathang d, chitietddh ct, traicay tc WHERE YEAR(NgayGiao) = ' ".$dong["Nam"]." '  AND d.MaDDH = ct.MaDDH AND ct.MaTraiCay = tc.MaTraiCay GROUP BY tc.MaTraiCay";
				$ketquatraicay = mysqli_query($conn,$truyvantraicay);
				$chuoijsontraicay = array();
				if($ketquatraicay){
					while ( $dongtraicay = mysqli_fetch_array($ketquatraicay) ) {
						array_push($chuoijsontraicay,array("MaTraiCay"=>$dongtraicay["MaTraiCay"],"TenTraiCay"=>$dongtraicay["TenTraiCay"],"SoLuongBan"=>$dongtraicay["SoLuongBan"],"SoTienBan"=>$dongtraicay["SoTienBan"],"HinhTraiCay"=>$dongtraicay["HinhTraiCay"]));
					}
				}

				$truyvannguoidung = "SELECT nd.MaNguoiDung, nd.TenNguoiDung, COUNT(nd.MaNguoiDung) SoLanMua, SUM(ct.SoLuongDat*ct.GiaBanHD) TongTienMua FROM dondathang d, chitietddh ct, nguoidung nd WHERE YEAR(NgayGiao) = ' ".$dong["Nam"]." ' AND d.MaDDH = ct.MaDDH AND d.MaNguoiDung = nd.MaNguoiDung GROUP BY nd.MaNguoiDung";
				$ketquanguoidung = mysqli_query($conn,$truyvannguoidung);
				$chuoijsonnguoidung = array();
				if($ketquanguoidung){
					while ( $dongnguoidung = mysqli_fetch_array($ketquanguoidung) ) {
						array_push($chuoijsonnguoidung,array("MaNguoiDung"=>$dongnguoidung["MaNguoiDung"],"TenNguoiDung"=>$dongnguoidung["TenNguoiDung"],"SoLanMua"=>$dongnguoidung["SoLanMua"],"TongTienMua"=>$dongnguoidung["TongTienMua"]));
					}
				}
				array_push($chuoijson, array("Nam"=>$dong["Nam"],"SoLuongDDH"=>$dong["SoLuongDDH"],"ChiTietTrangThai"=>$chuoijsontrangthai,"ThongKeTraiCay"=>$chuoijsontraicay,"ThongKeNguoiDung"=>$chuoijsonnguoidung));

			}
		}

		echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);

		echo "}";
	}
?>