<?php
if ($row > 0) {
    ?>
        <a href="../view/student_activity_type_year_run.php?acttype=<?php echo $rowallmore['acttypeName']; ?>&&actyear=<?php echo $year ?>"><?php echo $row ?></a>
    <?php
} else if ($row < 1) { }
?>