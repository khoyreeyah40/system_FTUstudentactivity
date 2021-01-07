<?php
if ($row1 > 0) {
    ?>
        <a href="../view/student_activity_type_year_reg.php?acttype=<?php echo $rowget1['acttypeName']; ?>&&actyear=<?php echo $year ?>"><?php echo $row1 ?></a>
    <?php
} else if ($row1 < 1) { }
?>