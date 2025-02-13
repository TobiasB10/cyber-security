<?php
include("back_end/MasterPage.php");
include("back_end/sql.php");
$masterPage = new MasterPage("Home");
echo $masterPage->createPage();

function createpage()
{
$preview = <<<PREVIEW
<div class="card bg-secondary mb-3" style="max-width: 200rem; height: 28rem">
  <div class="card-header">USERNAME GOES HERE</div>
  <div class="card-body">
    <h4 class="card-title">BLOG TITLE</h4>
    <p class="card-text">A LITTLE PREVIEW OF THE BLOG</p>
  </div>
</div>
<div class="card bg-secondary mb-3" style="max-width: 200rem; height: 28rem">
  <div class="card-header">USERNAME GOES HERE</div>
  <div class="card-body">
    <h4 class="card-title">BLOG TITLE</h4>
    <p class="card-text">A LITTLE PREVIEW OF THE BLOG</p>
  </div>
</div>
<div class="card bg-secondary mb-3" style="max-width: 200rem; height: 28rem">
  <div class="card-header">USERNAME GOES HERE</div>
  <div class="card-body">
    <h4 class="card-title">BLOG TITLE</h4>
    <p class="card-text">A LITTLE PREVIEW OF THE BLOG</p>
  </div>
</div>
<div class="card bg-secondary mb-3" style="max-width: 200rem; height: 28rem">
  <div class="card-header">USERNAME GOES HERE</div>
  <div class="card-body">
    <h4 class="card-title">BLOG TITLE</h4>
    <p class="card-text">A LITTLE PREVIEW OF THE BLOG</p>
  </div>
</div>
PREVIEW;
return $preview;    
}
echo createpage();










?>