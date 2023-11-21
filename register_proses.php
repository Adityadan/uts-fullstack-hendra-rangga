<?php  
require_once("class/user.php");

if(isset($_POST['registrasi'])) 
{	
	$data = array();
	$data['userid']=$_POST['userid'];
	$data['nama']=$_POST['nama'];
	$data['password']=$_POST['password'];
	$data['ulangi_password']=$_POST['ulangi_password'];
	if($data['password'] == $data['ulangi_password']) {
		$users = new Users();
		$users->registrasi($data);
	}

}

header("location: register.php");
?>