<?php
if($row1 > 0){
    ?>
    <a href="../view/organizer_activity_type_sem_reg.php?stdUser=<?php echo $stdUser ?>&&acttype=<?php echo $rowget1['acttypeName']; ?>&&actyear=<?php echo $year ?>&&actsem=<?php echo $rowget1['actSem']; ?>"><?php echo $row1 ?></a>
    <?php 
}else if($row1 < 0){ }
?>