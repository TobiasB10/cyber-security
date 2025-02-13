<?php
include("back_end/MasterPage.php");
include("back_end/sql.php");
$masterPage = new MasterPage("Home");
echo $masterPage->createPage();
session_destroy();


function createpage()  
{

    $profile = <<<PROFILE
    








    PROFILE;
        return $profile;

}
?>