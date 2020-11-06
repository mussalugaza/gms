<?php
$vdomain = preg_replace('|^mail\.|i', '', getenv('HTTP_HOST'));
   $vdomain = Horde_String::lower($vdomain);
?>
<html lang="en-GB"><head>
  <title>Government Mailing System :: Log in</title>
</head>

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

<div class="modal-faq login-container faq-height">
   <div class="menu-icons">
      <a title="Frequently asked questions (FAQ)" href="gms_faq.php"><div class="faq"></div></a>
      <a title="Policies"href="gms_policies.php"><div class="policies"></div></a>
  <a title="Back to Login"href="login.php"><img src="img/login.png"><div class="back_login"></div></a>   
</div>
    <div class="tr_title">
      <p>Policies</p>
    </div>
    <div class="page">
     <P>
      <h2 class="what"><span>Policies will be Uploaded Soon</span></h2><p><strong>Work in progress...</strong> </p>
     </P>
    
     
    </div>
  <div class="footer">
    <p>Visit the Government Portal <a href="http://www.tanzania.go.tz" target="_blank">www.tanzania.go.tz</a>  “A One Stop Centre for Public Information and Services”.  For any Technical inquiry, Please contact  your ICT Support Team at :  <span class="reverse">@troppustci</span><?php echo $vdomain ?>.</p> 
  </div>
  
</div>
<br>
<?php
try {
    echo $registry->loadConfigFile('motd.php', 'motd', 'horde')->config['motd'];
} catch (Horde_Exception $e) {}
