<?php

if (isset($_POST['submit'])) {

    echo "SETTING PRICE";
} //isset-submit

?>
<form action="?" method="POST" enctype="multipart/form-data">


    <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
    </div>
    <span id="skip-value-lower" class="example-val">30.00</span>
    <span id="skip-value-upper" class="example-val">700.00</span>
    <input type='submit'>
    <button class="aa-filter-btn" type="submit">Filter PRICE</button>

</form>