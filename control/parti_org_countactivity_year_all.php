<?php
if ($rowall > 0) {
    ?>
        <a href="../view/organizer_activity_type_year_all.php?stdUser=<?php echo $stdUser ?>&&acttype=<?php echo $rowallmore['acttypeName']; ?>&&actyear=<?php echo $year ?>"><?php echo $rowall ?></a>
    <?php
} else if ($rowall < 1) { }
?>