<?php foreach ($markers as $hehe):?>
  <?php echo $hehe['barrier_id']." ".$hehe['barrier_latitude']." ".$hehe['barrier_longitude']." ".$hehe['barrier_status']."<br>";
  ?>
<?php endforeach; ?>
<?php echo "<br>"?>
<?php echo "ysaganda <br>"?>
<?php echo $marker['barrier_salt']."<br>"?>
<?php echo hash('sha256', "ysaganda".$marker['barrier_salt'])."<br>" ?>
<?php echo $marker['barrier_password']."<br>" ?>
