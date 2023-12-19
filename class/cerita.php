<?php
require_once("parent.php");
// session_start();

class Cerita extends Parentclass
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insercerita($data)
    {
        $judul = isset($data['judul']) ? $data['judul'] : "";
        //$pembuat_awal = isset($data['pembuat_awal']) ? $data['pembuat_awal'] : "";
        $paragraf = isset($data['paragraf']) ? $data['paragraf'] : "";
        $user = $_SESSION['userid'];

        $sql = "Insert Into cerita (judul,id_user_pembuat_awal) Values (?,?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $judul, $user);
        $stmt->execute();

        $idcerita = $stmt->insert_id;
        $stmt->close();
        $this->insertparagraf($judul, $paragraf, $idcerita, $user);
        return $idcerita;
    }
    public function insertparagraf($judul, $paragraf, $idcerita)
    {
        $user = $_SESSION['userid'];

        $currentTimestamp = time();
        $formattedDateTime = date('Y-m-d H:i:s', $currentTimestamp);

        try {
            $sql2 = "INSERT INTO paragraf (iduser, idcerita, isiparagraf, tgl_buat) VALUES (?, ?, ?, ?)";
            $stmt2 = $this->mysqli->prepare($sql2);

            if (!$stmt2) {
                throw new Exception("Error preparing statement: " . $this->mysqli->error);
            }

            $stmt2->bind_param("iiss", $user, $idcerita, $paragraf, $formattedDateTime);

            if (!$stmt2->execute()) {
                throw new Exception("Error executing statement: " . $stmt2->error);
            }

            // Success
            return "Sukses";
        } catch (Exception $e) {
            // Handle the exception (e.g., log the error)
            // You can customize this part based on your needs
            return "Gagal: " . $e->getMessage();
        }
    }

    public function getcerita($iduser = '', /* $cariJudul = "", */ $offset = 0, $limit = null)
    {
        $sql = "SELECT
                cerita.*,
                user.nama,
                COUNT(paragraf.idparagraf) AS jumlah_paragraf
            FROM
                cerita
            JOIN
                paragraf ON cerita.idcerita = paragraf.idcerita
            JOIN user ON cerita.id_user_pembuat_awal = user.idusers    
            WHERE user.idusers = ?";
            $sql .= "
            GROUP BY
            cerita.idcerita";
        if (!is_null($limit)) {
            $sql .= " LIMIT ? OFFSET ?";
        }
        
        $stmt = $this->mysqli->prepare($sql);
        if (is_null($limit)) {
            $stmt->bind_param("s",/*  $cariJudul, */ $iduser);
        } else {
            $stmt->bind_param("sii",/*  $cariJudul, */ $iduser,$limit,$offset);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function getceritaall($offset = 0, $limit = null)
    {
        $sql = "SELECT
                cerita.*,
		        user.nama,
                COUNT(paragraf.idparagraf) AS jumlah_paragraf
            FROM
                cerita
            JOIN
                paragraf ON cerita.idcerita = paragraf.idcerita
		    JOIN user ON cerita.id_user_pembuat_awal = user.idusers 
            GROUP BY
                cerita.idcerita";

        if (!is_null($limit)) {
            $sql .= " LIMIT ? OFFSET ?";
        }

        $stmt = $this->mysqli->prepare($sql);

        if (($limit)) {
            $stmt->bind_param("ii", $limit,$offset);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
    public function detailcerita($idcerita)
    {
        $sql = "SELECT * FROM cerita LEFT JOIN paragraf ON paragraf.idcerita = cerita.idcerita WHERE cerita.idcerita = ?";
        // Prepare the statement
        $stmt = $this->mysqli->prepare($sql);

        // Bind parameters
        $stmt->bind_param("i", $idcerita);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch all rows as an associative array
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
        // Close the statement and connection
        $stmt->close();
        $this->mysqli->close();
    }
    public function updateIsiParagraf($idcerita)
    {
        $hasil = "";
        $id = isset($data['idcerita']) ? $data['idcerita'] : "";

        // echo $formattedDateTime;
        $sql = "SELECT * FROM paragraf where idcerita = $id";
        $result = $this->mysqli->query($sql);
        if ($result === false) {
            echo "Query failed: " . $this->mysqli->error;
        }
        if ($result->num_rows > 0) {
            // Output data dari setiap baris
            while ($row = $result->fetch_assoc()) {
                $iduser = $row["iduser"];
                $isiparagraf = $row["isiparagraf"];
                // echo "ID Paragraf: " . $row["idparagraf"] . "<br>";
                // echo "ID User: " . $row["iduser"] . "<br>";
                // echo "ID Cerita: " . $row["idcerita"] . "<br>";
                // echo "Isi Paragraf: " . $row["isiparagraf"] . "<br>";
                // echo "Tanggal Buat: " . $row["tgl_buat"] . "<br>";
                // echo "--------------------------------------<br>";

                $sql2 = "Insert into paragraf (iduser,idcerita,isiparagraf) Values (?,?,?)";
                $stmt2 = $this->mysqli->prepare($sql2);

                $stmt2->bind_param("iis", $iduser, $idcerita, $isiparagraf);
                $stmt2->execute();
                $hasil = "berhasil tambah paragraf";
            }
        } else {
            $hasil = "Tidak ada data paragraf yang ditemukan.";
        }

        return $hasil;
    }
}
