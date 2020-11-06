<?php
$vdomain = preg_replace('|^mail\.|i', '', getenv('HTTP_HOST'));
   $vdomain = Horde_String::lower($vdomain);
?>
<style>
span.reverse {
  unicode-bidi: bidi-override;
  direction: rtl;
}
</style>
<div class="tr_logo">
  <p id="tr_head">The United Republic of Tanzania</p>
  <p id="tr_tail">Government Mailing System</p>
</div>

<div class="modal-form">

<?php if (!is_null($auth_label)): ?>
 <div class="label login-app"><?php echo $auth_label ?></div>
<?php endif; ?>

<?php $notification->notify(array('listeners' => 'status')) ?>

<div class="tr_logp">
  <p>Login to Your Account</p>
</div>

<form name="horde_login" id="horde_login" method="post" action="<?php echo $loginurl ?>" autocomplete="off">
 <input type="hidden" name="app" id="app" value="<?php echo htmlspecialchars($vars->app) ?>" />
 <input type="hidden" name="login_post" id="login_post" value="0" />
 <input type="hidden" name="url" value="<?php echo htmlspecialchars($vars->url) ?>" />
 <input type="hidden" name="anchor_string" id="anchor_string" value="<?php echo htmlspecialchars($vars->anchor_string) ?>" />

<?php foreach ($loginparams as $key => $val): ?>
<?php if ($val['type'] == 'hidden'): ?>
<input type="hidden" id="<?php echo $key ?>" name="<?php echo $key ?>" value="<?php echo isset($val['value']) ? htmlspecialchars($val['value']) : '' ?>" />
<?php elseif ($val['type'] == 'horde_select_view'): ?>

<div id="horde_select_view_div" style="display:none" class="tr_hsel">
 <div id="tr_slabel"><?php echo Horde::label('horde_select_view', _("Mode")) ?></div>
 <div>
  <select id="horde_select_view" name="horde_select_view" class="tr_sview">
   <option value="auto"><?php echo _("Automatic") ?></option>
   <option value="" disabled="disabled">- - - - - - - - - -</option>
   <!--  option value="basic" selected="selected"><?php echo _("Basic") ?></option -->
   <option value="dynamic"><?php echo _("Computer (PC/Laptop)") ?></option>
   <option value="smartmobile"><?php echo _("Mobile (Smartphone/Tablet)") ?></option>
   <option value="mobile"><?php echo _("Mobile (Minimal)") ?></option>
   <option value="mobile_nojs" selected="selected"><?php echo _("Mobile (No JavaScript)") ?></option>
  </select>
 </div>
</div>
<?php else: ?>

<div id="tr_usr"><?php echo Horde::label($key, $val['label']) ?></div>
<div id="tr_input">
  <?php if ($val['type'] == 'text'): ?>
  <input type="text" class = "tr_uname" autocapitalize="off" autocorrect="off" id="<?php echo $key ?>" name="<?php echo $key ?>" value="<?php echo isset($val['value']) ? htmlspecialchars($val['value']) : '' ?>" style="direction:ltr" />

  <?php elseif ($val['type'] == 'password'): ?>
  <input type="password" class="tr_upass" id="<?php echo $key ?>" name="<?php echo $key ?>" value="" style="direction:ltr" />
  <?php if ($key == 'horde_pass'): ?>
</div>

<div id="horde-login-pass-capslock" style="display:none">
 <?php echo _("Warning: Your Caps Lock key is on!") ?>
<?php endif; ?>
<?php elseif ($val['type'] == 'select'): ?>
 <select id="<?php echo $key ?>" name="<?php echo $key ?>">
<?php foreach ($val['value'] as $k2 => $v2): ?>
<?php if (is_null($v2)): ?>
  <option value="" disabled="disabled">- - - - - - - - - -</option>
<?php else: ?>
  <option value="<?php echo $k2 ?>"<?php echo !empty($v2['selected']) ?' selected="selected"' : '' ?><?php echo !empty($v2['hidden']) ? ' style="display:none"' : '' ?>><?php echo htmlspecialchars($v2['name']) ?></option>
<?php endif; ?>
<?php endforeach ?>
 </select>
<?php endif; ?>
</div>
<?php endif; ?>
<?php endforeach; ?>

<?php if (!$is_auth && !$prefs->isLocked('language')): ?>


<div style="display:none;" id="tr_slabel"><?php echo Horde::label('new_lang', _("Language")) ?></div>
<div style="display:none;"><select id="new_lang" name="new_lang" class="tr_sview">
<option value="en_GB" selected="selected">English</option>
<!--
<?php foreach ($langs as $val): ?>
        <option value="<?php echo $val['val'] ?>"<?php echo ($val['sel'] ? ' selected="selected"' : '') ?>><?php echo $val['name'] ?></option>
<?php endforeach; ?>-->
</select></div>
<?php endif; ?>

<div>
 <input id="login-button" name="login_button" class="horde-default submit-button" value="<?php echo _("Log in") ?>" type="submit" />
</div>

<div class="tr_advert">
<p>Visit the Government Portal <a href="http://www.tanzania.go.tz" target="_blank">www.tanzania.go.tz</a>  “A One Stop Centre for Public Information and Services”. For any Technical inquiry, Please contact  your ICT Support Team at :  <span class="reverse">@troppustci</span><?php echo $vdomain ?>.</p>
</div>

<?php
$add_user = (!empty($conf['signup']['allow']) && $auth->hasCapability('add'));
$reset_passwd = !empty($conf['auth']['resetpassword']) && $auth->hasCapability('resetpassword');
?>

<?php if ($add_user || $reset_passwd): ?>
<div class="extras">
<?php if ($add_user): ?>
 <?php echo Horde::link(Horde::url('signup.php', false, array('app' => 'horde'))->add('url', $vars->url), _("Don't have an account? Sign up."), 'light') . _("Don't have an account? Sign up.") ?></a>
<?php endif; ?>

<?php if ($reset_passwd): ?>
<?php if ($add_user): ?>
 <br />
<?php endif; ?>
 <?php echo Horde::link(Horde::url('services/resetpassword.php', false, array('app' => 'horde'))->add('url', $vars->url), _("Forgot your password?"), 'light') . _("Forgot your password?") ?></a>
<?php endif; ?>
</div>
<?php endif; ?>

</form>
</div>

<?php
try {
    echo $registry->loadConfigFile('motd.php', 'motd', 'horde')->config['motd'];
} catch (Horde_Exception $e) {}
