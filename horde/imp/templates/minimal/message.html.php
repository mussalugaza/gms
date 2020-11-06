<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
                <!-- Content Header (Page header) -->

                <!-- Main content -->
                <section class="content">
                    <!-- MAILBOX BEGIN -->
                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                                 This is an example of having the box header within the box body -->
                                            <!-- <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title"></h3>
                                            </div> -->
                                            <!-- compose message btn -->
                                            <?php $i = 0; $nmsg = "false"; foreach ($this->menu as $val): 
                                            $mt = $this->h($val[0]);                                                 
                                            if($mt == "New Message"): ?>    
                                           	 <a class="btn btn-block btn-primary" accesskey="<?php echo $i ?>" href="<?php echo $val[1] ?>" ><i class=""></i> New Message</a>
                                            <?php $nmsg = "true"; endif; $i++; endforeach; ?>
                                            <?php if($nmsg =="false"): ?>
                                               <a class="btn btn-block btn-primary" href="#" ><i class=""></i> New Message</a>
                                            <?php endif; ?>
                                            <!-- Navigation - folders-->
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Folders</li>
                                                   <li><a href="#"><i class="icon"></i><span class="icon_span"><?php echo $this->tree; ?></span></a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                        <div style="text-align:center; font-size:15px;"><?php echo $this->h($this->title) ?></div>
                                            <div class="row pad">
                                                <div class="col-sm-6">
                                                    <!-- Action button -->
                                                    <div class="btn-group">
                                                        <select name="checkbox">
   <option value="" selected="selected"><?php echo _("Action") ?></option>
<?php if ($this->delete): ?>
   <option value="d">&nbsp;<?php echo _("Delete") ?></option>
   <option value="u">&nbsp;<?php echo _("Undelete") ?></option>
<?php endif; ?>
   <option value="rs">&nbsp;<?php echo _("Report As Spam") ?></option>
   <option value="ri">&nbsp;<?php echo _("Report As Innocent") ?></option>
  </select>
  <input type="submit" value="<?php echo _("Do Action") ?>" />
                                                    </div>

                                                </div>
                                                
                                            </div><!-- /.row -->

                                            <div class="table-responsive">
                                                <!-- THE MESSAGES -->
                                                <p>
<?php foreach ($this->hdrs as $val): ?>
 <div>
  <em><?php echo $val['label'] ?>:</em>
  <?php echo $this->h($val['val']) ?>
<?php if (isset($val['all_to'])): ?>
  [<a href="<?php echo $val['all_to'] ?>"><?php echo _("Show All") ?></a>]
<?php endif; ?>
 </div>
<?php endforeach; ?>

<?php foreach ($this->atc as $val): ?>
 <div>
  <em><?php echo _("Attachment") ?>:</em>
  <?php echo $val['descrip'] ?>
  (<?php echo $val['type'] ?>)
  <?php echo $val['size'] ?>
<?php if (isset($val['view'])): ?>
  [<a href="<?php echo $val['view'] ?>"><?php echo _("View") ?></a>]
<?php endif; ?>
<?php if (isset($val['download'])): ?>
  [<a href="<?php echo $val['download'] ?>"><?php echo _("Download") ?></a>]
<?php endif; ?>
 </div>
<?php endforeach; ?>
</p>

<p>
 <hr />
</p>

<p class="fixed">
 <?php echo htmlspecialchars_decode($this->msg, $quote_style = null);  ?>
 
</p>
                                                
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                               


<?php if (isset($this->fullmsg_link)): ?>
<p>
 <a href="<?php echo $this->fullmsg_link ?>"><?php echo _("View Full Message") ?></a>
</p>
<?php endif; ?>
