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
                                                    <?php $i = 0; $ibox = "false"; foreach ($this->menu as $val): 
                                                    $mt = $this->h($val[0]);                                                 
                                                    if($mt == "Inbox"): ?>
                                                    <li class="active"><a accesskey="<?php echo $i ?>" href="<?php echo $val[1] ?>" ><i id="inbox" class="icon"></i><span class="icon_span"><?php echo $this->h($val[0]) ?></span></a></li>
                                                    <?php $ibox = "true"; endif; $i++; endforeach; ?>
                                                    
                                                    <?php if($ibox =="false"): ?>
                                                      <li><a href="#"><i id="inbox" class="icon"></i><span class="icon_span">Inbox</span></a></li>
                                                    <?php endif; ?>

                                                    <li><a href="#"><i id="draft" class="icon"></i><span class="icon_span">Drafts</span></a></li>

                                                    <li><a href="#"><i id="sent" class="icon"></i><span class="icon_span">Sent</span></a></li>
                                                    <li><a href="#"><i id="trash" class="icon"></i><span class="icon_span">Trash</span></a></li>
                                                    <li><a href="#"><i id="junk" class="icon"></i><span class="icon_span">Junk</span></a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
<div style="text-align:center; font-size:15px;"><?php echo $this->h($this->title) ?></div>
                                            <div class="row pad">
                                                <div class="col-sm-6">
                                                    <!-- Action button -->
                                                    

                                                </div>
                                                <!-- <div class="col-sm-6 search-form">
                                                    <form action="#" class="text-right">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-sm" placeholder="Search">
                                                            <div class="input-group-btn">
                                                                <button type="submit" name="q" class="btn btn-sm btn-primary"><i id="search" class="icon"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div> -->
                                            </div><!-- /.row -->

                                            <div class="col-md-8">
                                                <!-- THE MESSAGES -->
                                                <form action="<?php echo $this->url ?>" method="post" <?php if (!$this->attach_name): ?>enctype="multipart/form-data" <?php endif; ?>>
 <input type="hidden" name="composeCache" value="<?php echo $this->h($this->cacheid) ?>" />
 <input type="hidden" name="composeHmac" value="<?php echo $this->h($this->hmac) ?>" />
 <input type="hidden" name="user" value="<?php echo $this->h($this->user) ?>" />

<?php if (count($this->identities) > 1): ?>
 <p>
  <label for="identity">
   <?php echo _("From:") ?>
   <select id="identity" name="identity">
<?php foreach ($this->identities as $val): ?>
    <option value="<?php echo $val['key'] ?>"<?php if ($val['sel']): ?> selected="selected"<?php endif; ?>><?php echo $this->h($val['val']) ?></option>
<?php endforeach; ?>
   </select>
  </label>
 </p>
<?php endif; ?>

<?php foreach ($this->hdrs as $val): ?>
 
   <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><?php echo $this->h($val['label']) ?></span>
     
      <input id="<?php echo $val['key'] ?>" name="<?php echo $val['key'] ?>" value="<?php echo str_replace("\"", "", $val['val']); ?>" class="form-control">
    </div>
   </div>
<?php if (isset($val['matchlabel'])): ?>
 <blockquote>
  <div><?php echo $this->h($val['matchlabel']) ?></div>
<?php foreach ($val['match'] as $val2): ?>
  <div>
   <label for="<?php echo $val2['id'] ?>">
    <input type="checkbox" name="<?php echo $val2['id'] ?>" id="<?php echo $val2['id'] ?>" value="<?php echo $this->h($val2['val']) ?>" /><?php echo $this->h($val2['val']) ?>
   </label>
  </div>
<?php endforeach; ?>
 </blockquote>
<?php endif; ?>
<?php endforeach; ?>

<div class="form-group">
                                
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><?php echo _("Subject:") ?></span>
    <input name="subject" value="<?php echo $this->h($this->subject) ?>" class="form-control" placeholder="Subject">
  </div>
</div>
 
 <div class="form-group">
   <textarea name="message" id="email_message" class="form-control" placeholder="Message" style="height: 120px;" rows="10" cols="80"><?php echo $this->h($this->msg) ?></textarea>
 </div>

 <p>
<?php if ($this->compose_enable): ?>
  <input type="submit" name="a" value="<?php echo _("Send") ?>" />
<?php endif; ?>
<?php if ($this->save_draft): ?>
  <input type="submit" name="a" value="<?php echo _("Save Draft") ?>" />
<?php endif; ?>
  <input type="submit" name="a" value="<?php echo _("Expand Names") ?>" />
  <input type="submit" name="a" value="<?php echo _("Cancel") ?>" />
<?php if ($this->resume): ?>
  <input type="submit" name="a" value="<?php echo _("Discard Draft") ?>" />
<?php endif; ?>
 </p>

<?php if ($this->attach): ?>
 <hr />
 
 <div class="form-group">
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> <?php echo _("Attachment:") ?>
                                    <?php if ($this->attach_name): ?>
  <?php echo $this->h($this->attach_name) ?> [<?php echo $this->h($this->attach_type) ?>] - <?php echo $this->attach_size ?>
<?php else: ?>
                                    <input name="upload_1" type="file"/>
                                    <?php endif; ?>
                                </div>
                                <p class="help-block">Max. 20MB</p>
                            </div>
<?php endif; ?>
</form>
                                              

                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                





