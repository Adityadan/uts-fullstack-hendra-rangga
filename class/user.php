<?php
require_once("parent.php");
// require_once("menu.php");

session_start();

class Users extends Parentclass
{
	public function __construct()
	{
		parent::__construct();
	}

	private function generateSalt()
	{
		return substr(sha1(date("YmdHis")), 0, 10);
	}

	private function encryptPwd($plainPwd, $salt)
	{
		return sha1(sha1($plainPwd) . $salt);
	}

	private function getSalt($userid)
	{
		$sql = "Select salt From user Where idusers=?";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("s", $userid);
		$stmt->execute();
		$res = $stmt->get_result();
		if ($row = $res->fetch_assoc()) return $row['salt'];
		else return "";
	}
	private function createSession($row)
	{
		$_SESSION['userid'] = $row['idusers'];
		$_SESSION['nama'] = $row['nama'];
	}
	public function doLogin($userid, $pwd)
	{
		$salt = $this->getSalt($userid);
		$encrypted_pwd = $this->encryptPwd($pwd, $salt);
		$sql = "Select * From user Where nama=? And password=?";
		$stmt = $this->mysqli->prepare($sql);

		$stmt->bind_param("ss", $userid, $encrypted_pwd);
		$stmt->execute();
		$res = $stmt->get_result();
		// echo '<pre>' . var_export($res, true) . '</pre>';
		// die();
		if ($res->num_rows > 0) {
			$this->createSession($res->fetch_assoc());
			return "sukses";
		} else return "gagal";
	}
	public function registrasi($arrData)
	{
		$sql = "Insert Into user (nama,password,salt) Values (?,?,?)";
		$stmt = $this->mysqli->prepare($sql);
		$salt = $this->generateSalt();
		$encrypted_pwd = $this->encryptPwd($arrData['password'], $salt);
		$stmt->bind_param("sss", $arrData['nama'], $encrypted_pwd, $salt);
		$stmt->execute();
	}
}
