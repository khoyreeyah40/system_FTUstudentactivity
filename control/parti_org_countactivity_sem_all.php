<?php
if($rowall > 0){
    ?>
    <a href="../view/organizer_activity_type_sem_all.php?stdUser=<?php echo $stdUser ?>&&acttype=<?php echo $rowallmore['acttypeName']; ?>&&actyear=<?php echo $year ?>&&actsem=<?php echo $rowallmore['actSem']; ?>"><?php echo $rowall ?></a>
    <?php 
}elseif($rowall < 1){ }
?>