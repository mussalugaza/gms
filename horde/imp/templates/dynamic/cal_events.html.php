<?php
$vdomain =getenv('HTTP_HOST');
?>
<div id = "events_lists" class="horde-subnavi" style="width:100%; display: inline-block; white-space:normal; position: relative; top: 1em; bottom: 20px; overflow:auto;">
<div id="kronolithCal"></div>
<script src="https://<?php echo $vdomain;?>/services/ajax.php/kronolith/embed?container=kronolithCal&view=Summary" type="text/javascript"></script>
</div>
