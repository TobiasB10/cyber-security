<?php
include("back_end/MasterPage.php");
include("back_end/sql.php");
$masterPage = new MasterPage("Home");
echo $masterPage->createPage();



function createpage()
{
$createBlog = <<<CREATEBLOG
 <div>
      <label for="formFile" class="form-label mt-4">Default file input example</label>
      <input class="form-control" type="file" id="formFile">
    </div>

CREATEBLOG;
return $createBlog;    
    
}
echo createpage();

?>