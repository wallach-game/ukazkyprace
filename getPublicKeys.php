<?php 
require "../dbConnect.php";
$id = 1;
$mainQuery = $db->prepare("SELECT ID,  public_key,  validFrom,  validTo FROM oauth2.company_public_keys WHERE company_id = :id");
$mainQuery->execute(['id' => $id]);
$data = array();
while($row = $mainQuery->fetch(PDO::FETCH_NUM)) {
    array_push($data,$row);
}
//var_dump($data);

for($x = 0;$x < count($data);$x++)
{
    //výpočet kryptografického otisku z klíče v databázi.
    $nHKey = $data[$x][1];
    $data[$x][1] = hash("md5",$nHKey);
}

//var_dump($data);
echo json_encode($data);
?>