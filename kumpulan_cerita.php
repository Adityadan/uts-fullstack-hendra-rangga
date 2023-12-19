<?php
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
$sql .= " LIMIT ?, ?";
}

$stmt = $this->mysqli->prepare($sql);

if (($limit)) {
$stmt->bind_param("ii", $offset, $limit);
}

$stmt->execute();
return $stmt->get_result();