<?php 
require "../dbConnect.php";
if(isset($_GET["id"]));
{
    $query = $db->prepare("DELETE FROM oauth2.company_public_keys WHERE  ID = :id;");
    $query->execute(["id" => $_GET["id"]]);

    $link = "<script>
    window.location.href = ('../API_html_edited/keys.html')</script>";
    echo $link;
}
?>