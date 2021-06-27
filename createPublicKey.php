<?php 
require "../dbConnect.php";
ob_start();
MainLogic($db);
ob_end_flush();

function MainLogic($db)
{
    InputCheck();
    NewKeyLogic($_POST["validFrom"],$_POST["validTo"],$db);
}

function NewKeyLogic($validFrom,$validTo,$db)
{
    $id = 1;
    $key = GenerateKey();
    $time = time();
    $validFrom = strtotime($validFrom);
    $validTo = strtotime($validTo);
    if($validFrom > $validTo)
    {
        JavascriptAlert("Začátek platnosti nemůže být později než konec");
        return;
    }
    $query = $db->prepare("INSERT INTO oauth2.company_public_keys (company_id, public_key, validFrom, validTo, timestamp) VALUES (:id, :key, :validFrom , :validTo, :timestamp);");
    $query->execute(["id" => $id,
                    "key" => $key,
                    "validFrom" => $validFrom,
                    "validTo" => $validTo,
                    "timestamp" => $time]);
    JavascriptAlert("Vygeneroval jsem klíč ********** KEYSTARTHERE---->$key<----KEYENDHERE ********** prosím zkopírujte si jej nebo opište! Klíč nepujde znova získat!");
}

function GenerateKey()
{
    require("generateKey.php");
    return $key;
}

function InputCheck()
{
    if( 
    isset($_POST["validFrom"])
    && isset($_POST["validTo"]) 
    && ($_POST["validFrom"] != "") 
    && ($_POST["validTo"] != "")
    )
    {
      return;
    }
    else
    {
        JavascriptAlert("Nezadaný datum platnosti - Negeneruji klíč");
    }
}

function JavascriptAlert($alertText)
{
    $link = "<script>
    alert('$alertText');
    window.location.href = ('../API_html_edited/keys.html')</script>";
    echo $link;
}
?>