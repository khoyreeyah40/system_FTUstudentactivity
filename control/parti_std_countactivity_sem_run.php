<?php
if($row > 0){ 
    ?>
    <a href="../view/student_activity_type_sem_run.php?acttype=<?php echo $rowget['acttypeName']; ?>&&actyear=<?php echo $year ?>&&actsem=<?php echo $rowget['actSem']; ?>"><?php echo $row ?></a>
    <?php
}else if($row < 0){ }
?>