<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
 <head></head>
 <body>
  <div id="headerblock" class="fixed mimeHeaders mimeHeadersPrint">
<div style="position:absolute; left:2%; top:1%;"><img src="../themes/default/graphics/arm.png"
height="70" width="85"></div>
<?php foreach ($this->headers as $v): ?>
   <div>
    <strong><?php echo $this->h($v['header']) ?>:</strong>
    <?php echo $this->h($v['value']) ?>
   </div>
<?php endforeach; ?>
  </div>
 </body>
</html>
