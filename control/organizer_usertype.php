<?php
if (isset($_POST["btupdateusertype"])) {

$stmt = $session->runQuery('SELECT usertypeID FROM usertype');
$stmt->execute();
if ($stmt->rowCount() > 0) {
while ($roid = $stmt->fetch(PDO::FETCH_ASSOC)) {

        //menu1
        if (isset($_POST["cb1" . $roid["usertypeID"]])) {
            $trdo1 = "true";
        } else {
            $trdo1 = "false";
        }
        //menu2
        if (isset($_POST["cb2" . $roid["usertypeID"]])) {
            $trdo2 = "true";
        } else {
            $trdo2 = "false";
        }
        //menu3
        if (isset($_POST["cb3" . $roid["usertypeID"]])) {
            $trdo3 = "true";
        } else {
            $trdo3 = "false";
        }
        //menu4
        if (isset($_POST["cb4" . $roid["usertypeID"]])) {
            $trdo4 = "true";
        } else {
            $trdo4 = "false";
        }
        //menu5
        if (isset($_POST["cb5" . $roid["usertypeID"]])) {
            $trdo5 = "true";
        } else {
            $trdo5 = "false";
        }
        //menu6
        if (isset($_POST["cb6" . $roid["usertypeID"]])) {
            $trdo6 = "true";
        } else {
            $trdo6 = "false";
        }
        //menu7
        if (isset($_POST["cb7" . $roid["usertypeID"]])) {
            $trdo7 = "true";
        } else {
            $trdo7 = "false";
        }
        //menu8
        if (isset($_POST["cb8" . $roid["usertypeID"]])) {
            $trdo8 = "true";
        } else {
            $trdo8 = "false";
        }
        //menu9
        if (isset($_POST["cb9" . $roid["usertypeID"]])) {
            $trdo9 = "true";
        } else {
            $trdo9 = "false";
        }
        //menu10
        if (isset($_POST["cb10" . $roid["usertypeID"]])) {
            $trdo10 = "true";
        } else {
            $trdo10 = "false";
        }
        //menu11
        if (isset($_POST["cb11" . $roid["usertypeID"]])) {
            $trdo11 = "true";
        } else {
            $trdo11 = "false";
        }
        //menu12
        if (isset($_POST["cb12" . $roid["usertypeID"]])) {
            $trdo12 = "true";
        } else {
            $trdo12 = "false";
        }
        //menu13
        if (isset($_POST["cb13" . $roid["usertypeID"]])) {
            $trdo13 = "true";
        } else {
            $trdo13 = "false";
        }
        if (isset($_POST["cb14" . $roid["usertypeID"]])) {
            $trdo14 = "true";
        } else {
            $trdo14 = "false";
        }


        $stmt_1 = $session->runQuery("UPDATE usertype 
                    SET M_1='$trdo1',M_2='$trdo2',
                        M_3='$trdo3',M_4='$trdo4',
                        M_5='$trdo5',M_6='$trdo6',
                        M_7='$trdo7',M_8='$trdo8',
                        M_9='$trdo9',M_10='$trdo10',
                        M_11='$trdo11',M_12='$trdo12',
                        M_13='$trdo13',M_14='$trdo14'
                    WHERE usertypeID='$roid[usertypeID]'");
        $stmt_1->execute();
    }
}
}
if (isset($_POST['btaddusertype'])) {
$eutype = $_POST["userType"];
$eutypeSec = $_POST["usertypeSec"];
if ($eutype != "" && $eutypeSec != "") {
    $stmt = $session->runQuery("SELECT * FROM usertype WHERE userType='$eutype' && usertypeSec= '$eutypeSec' ");
    $stmt->execute();
    if ($stmt->rowCount()) {
        $errMSG = "ขออภัย!ประเภทผู้ใช้นี้ได้ถูกเพิ่มแล้ว";
    } else {

        //checkbox 1
        if (!isset($_POST["cb1"])) {
            $eucheck1 = "false";
        } else {

            $eucheck1 = $_POST["cb1"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 2
        if (!isset($_POST["cb2"])) {
            $eucheck2 = "false";
        } else {

            $eucheck2 = $_POST["cb2"];
            //echo "cb2 is not blank.".$eucheck2;
        }
        //checkbox 3
        if (!isset($_POST["cb3"])) {
            $eucheck3 = "false";
        } else {

            $eucheck3 = $_POST["cb3"];
            //echo "cb2 is not blank.".$eucheck2;
        }
        //checkbox 4
        if (!isset($_POST["cb4"])) {
            $eucheck4 = "false";
        } else {

            $eucheck4 = $_POST["cb4"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 5
        if (!isset($_POST["cb5"])) {
            $eucheck5 = "false";
        } else {

            $eucheck5 = $_POST["cb5"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 6
        if (!isset($_POST["cb6"])) {
            $eucheck6 = "false";
        } else {

            $eucheck6 = $_POST["cb6"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 7
        if (!isset($_POST["cb7"])) {
            $eucheck7 = "false";
        } else {

            $eucheck7 = $_POST["cb7"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 8
        if (!isset($_POST["cb8"])) {
            $eucheck8 = "false";
        } else {

            $eucheck8 = $_POST["cb8"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 9
        if (!isset($_POST["cb9"])) {
            $eucheck9 = "false";
        } else {

            $eucheck9 = $_POST["cb9"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 10
        if (!isset($_POST["cb10"])) {
            $eucheck10 = "false";
        } else {

            $eucheck10 = $_POST["cb10"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 11
        if (!isset($_POST["cb11"])) {
            $eucheck11 = "false";
        } else {

            $eucheck11 = $_POST["cb11"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 12
        if (!isset($_POST["cb12"])) {
            $eucheck12 = "false";
        } else {

            $eucheck12 = $_POST["cb12"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 13
        if (!isset($_POST["cb13"])) {
            $eucheck13 = "false";
        } else {

            $eucheck13 = $_POST["cb13"];
            //echo "cb1 is not blank.".$eucheck2;
        }
        //checkbox 14
        if (!isset($_POST["cb14"])) {
            $eucheck14 = "false";
        } else {

            $eucheck14 = $_POST["cb14"];
            //echo "cb1 is not blank.".$eucheck2;
        }

        //insert into database
        $stmt = $session->runQuery("INSERT INTO usertype (userType,usertypeSec,M_1, M_2, M_3, M_4, M_5, M_6, M_7, M_8, M_9, M_10, M_11, M_12, M_13, M_14, usertypeAddby) VALUES ('$eutype','$eutypeSec','$eucheck1','$eucheck2','$eucheck3','$eucheck4','$eucheck5','$eucheck6','$eucheck7','$eucheck8','$eucheck9','$eucheck10','$eucheck11','$eucheck12','$eucheck13','$eucheck14','$usertypeAddby')");
        if ($stmt->execute()) {
            $successMSG = "ทำการเพิ่มประเภทผู้ใช้เรียบร้อย";
            header("refresh:1; ../view/organizer_usertype.php");
        } else {
            $errMSG = "Error: " . $stmt . "<br>" ;
        }
    }
} else {
}
}
?>