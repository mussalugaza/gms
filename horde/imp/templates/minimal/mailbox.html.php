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
                                                <div class="col-sm-6 search-form pull-right" >
                                                
                                                <!-- <form action="<?php echo $this->url ?>" method="post"> -->
                                                
                                                
                                                    <form action="<?php echo $this->url ?>" method="post" class="text-right">
                                                        <div class="input-group">
                                                            <input type="hidden" name="a" value="ds" />
                                                            <input type="hidden" name="mailbox" value="<?php echo $this->mailbox ?>" />
                                                            <input name="search" type="text" class="form-control input-sm" placeholder="Search">
                                                            <div class="input-group-btn">
                                                                <button type="submit" class="btn btn-sm btn-primary"><i id="search" class="icon"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-sm-6">
                                                <form action="<?php echo $this->checkbox ?>" method="post">
 <input type="hidden" name="t" value="<?php echo $this->t ?>" />
 <?php if ($this->msgs): ?>
                                                    <label style="margin-right: 10px;">
                                                        <input type="checkbox" id="check-all"/>
                                                    </label>
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
                                                
                                                
                                                <table class="table table-mailbox">
                                                    <tr class="unread">
                                                        <th class="small-col"></th>
                                                        <th class="small-col"><i class="fa fa-star"></i></th>
                                                        <th class="name"><a href="#"><?php echo _("From") ?></a></th>
                                                        <th class="subject"><a href="#"><?php echo _("Subject") ?></a></th>
                                                        <th class="time"><a href="#"><?php echo _("Date") ?></a></th>
                                                         <th class="size"><a href="#"><?php echo _("Size") ?></a></th>
                                                    </tr>
                                                    <?php foreach ($this->msgs as $v): ?>
                                                    <tr class="<?php if($v['status']=='U'){ echo 'unread'; }?>">
                                                        <td class="small-col"><input type="checkbox" name="buid[]" value="<?php echo $v['buid'] ?>"/></td>
                                                        <td class="small-col"><i class="fa fa-star"></i></td>
                                                        <td class="name"><a href="#"><?php echo $this->h($this->truncate($v['from']), 50) ?></a></td>
                                                        <td class="subject"><a href="<?php echo $v['target'] ?>"><?php echo $this->h($this->truncate($v['subject'], 50)) ?></td>
                                                        <td class=""><a href="#"><?php echo $this->h($this->truncate($v['date']), 50) ?></a></td>
                                                        <td class="size"><a href="#"><?php echo $this->h($this->truncate($v['size']), 50) ?></a></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                                </form>
<?php else: ?>
<div><?php echo _("No messages.") ?></div>
<?php endif; ?>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                


