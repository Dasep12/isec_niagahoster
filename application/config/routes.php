<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//routing cek user
$route['api/cekAkun']          = 'API/ISECURITY/cekUser';
$route['api/loginPic']          = 'API/Absensi/loginPic';
$route['api/registerDevice']   = 'API/ISECURITY/registerDevice';

//routing api 
$route['getAPI']               = 'API/SGDP' ;
$route['api/biodata']          = 'API/ISECURITY/biodata';
$route['api/employe']          = 'API/ISECURITY/employe';
$route['api/employe/update']   = 'API/ISECURITY/update_employe';
$route['api/poto']             = 'API/ISECURITY/berkas';
$route['api/uploadImage']      = 'API/ISECURITY/uploadImage';
$route['api/updateBiodata']    = 'API/ISECURITY/updateBiodata';
$route['api/updateKTP']        = 'API/ISECURITY/updateKTP';
$route['api/updateDomisili']   = 'API/ISECURITY/updateDomisili';
$route['api/updateIMT']        = 'API/ISECURITY/updateIMT';
$route['api/profiling']        = 'API/ISECURITY/profiling';
$route['api/profilingAll']     = 'API/ISECURITY/profilingAll';


//data untuk absensi
$route['api/datadiriAbsensi']   = 'API/Absensi/cekDataDiri';
//routing absensi
$route['api/barcodeKorlap']     = 'API/Absensi/cekBarcodeKorlap';
$route['api/barcodeAnggota']    = 'API/Absensi/cekBarcodeAnggota';
$route['api/input_absen']       = 'API/Absensi/inputAbsensi';
$route['api/ambil_absen']       = 'API/Absensi/getAbsenFull';
$route['api/tokenKorlap']       = 'API/Absensi/showToken';
$route['api/ambilToken']        = 'API/Absensi/ambilToken';
$route['api/detail_absen']      = 'API/Absensi/detailAbsen';
$route['api/DaftarKorlap']      = 'API/Absensi/daftar_korlap';


//overtime
$route['api/ajukanLembur']      = 'API/Absensi/ajukanLembur';
$route['api/daftarLembur']      = 'API/Absensi/daftarLembur';
$route['api/statusLembur']      = 'API/Absensi/statusLembur';
$route['api/ApproveLembur']     = 'API/Absensi/approvalLemburan';



//skta
$route['api/ajukanSKTA']        = 'API/Absensi/ajukanSKTA';
$route['api/ApproveSKTA']       = 'API/Absensi/updateSKTA';
$route['api/statusSKTA']        = 'API/Absensi/statusSKTA';
$route['api/daftarSKTA']        = 'API/Absensi/daftarSKTA';



//cuti
$route['api/ajukanCuti']        = 'API/Absensi/ajukanCuti';
$route['api/daftarCuti']        = 'API/Absensi/daftarCuti';
$route['api/ApproveCuti']       =  'API/Absensi/approveCuti';
$route['api/DaftarAnggota']     = 'API/Absensi/ListpenggantiCuti';
$route['api/statusCuti']        = 'API/Absensi/statusCuti';


//sakit
$route['api/ajukanSakit']    = 'API/Absensi/ajukanSakit';
$route['api/daftarSakit']    = 'API/Absensi/daftarSakit';
$route['api/approveSakit']   = 'API/Absensi/approveSakit';
$route['api/StatusSakit']   = 'API/Absensi/statusSakit';


//logs 
$route['api/logOvertime']   = 'API/Absensi/logApprovalOT';
$route['api/logCuti']       = 'API/Absensi/logApprovalCuti';
$route['api/logSakit']       = 'API/Absensi/logApprovalSakit';
$route['api/logSKTA']       = 'API/Absensi/logApprovalSKTA';

$route['api/course']       = 'API/ISECURITY/course';

