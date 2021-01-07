<?php
    $dayTH = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
    $monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
    $monthTH_brev = [null,'ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
        function thai_date_short($time){
            global $dayTH,$monthTH_brev;   
            $thai_date_return = date("j",$time);   
            $thai_date_return.=" ".$monthTH_brev[date("n",$time)];   
            $thai_date_return.= " ".(date("Y",$time));   
            return $thai_date_return;   
        }
?>