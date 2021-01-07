<?php
    function DateThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 544;
        return "$strYear";
    }
        $strDate = date("Y");
        for ($i = 2560; $i < DateThai($strDate); $i++) 
        {
            echo "<option>$i</option>";
        }
?>