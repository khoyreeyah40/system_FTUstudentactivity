<?php
if($row > 0){ 
    ?>
    <a href="../view/organizer_activity_type_sem_run.php?stdUser=<?php echo $stdUser ?>&&acttype=<?php echo $rowget['acttypeName']; ?>&&actyear=<?php echo $year ?>&&actsem=<?php echo $rowget['actSem']; ?>"><?php echo $row ?></a>
    <?php
}else if($row < 0){ }
?>