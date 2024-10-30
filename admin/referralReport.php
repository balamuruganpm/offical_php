<?php
include('./include/header.php');

?>
<style>
    /* thead,th{
        text-align: center;
    }
    .btns{
       border: none;
        height: 40px;
        width: 100px;
        border-radius: 10px;
       
    }
    #pdf{
        background-image: url(https://www.pngall.com/wp-content/uploads/2/Downloadable-PDF-Button-PNG-High-Quality-Image.png);
        background-repeat: no-repeat;
        background-size: 90px 35px;
        box-shadow: 1px 1px;
        
    }
    #excel{
        background-image: url(https://blog.testproject.io/wp-content/uploads/2016/04/excel-logo-410x148.png);
        background-repeat: no-repeat;
        background-size: 70px 35px;
        box-shadow: 1px 1px green;
    }
    #csv{
        background-image: url(https://cdn0.iconfinder.com/data/icons/file-formats-flat-colorful-1/2048/1772_-_CSV-1024.png);
        background-repeat: no-repeat;
        background-size: 60px 40px;
        box-shadow: 1px 1px rgb(57,72,169);
      
        
    } */
</style>
<br>
<br>
<div style="display: flex; gap: 20px;">
    <span ><button class="btns" id="pdf"></button></span>
    <span><button class="btns" id="excel" style="width: 80px;"></button></span>
    <span><button class="btns" id="csv" style="width: 60px;"></button></span>
</div>
<br><br>

<?php
include('./include/footer.php');
?>