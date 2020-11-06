<?php include  __DIR__ . '/../../gms_title.php';?>
<div id="horde-head">

    <div id="horde-sub">
      <div id="horde-date"><?php echo $this->date ?> </div><a href="/util/GMS_user_manual.pdf" target="_blank" id="user-manual-link-document">User Manual</a>
      <div id="horde-logout"><a class="icon" title="<?php echo _("Log out") ?>" href="<?php echo $this->logoutUrl ?>">Logout</a></div>
      <div id="horde-info"><?php echo $this->subinfo ?></div>      
    </div>

  <div id="horde-logo"><a class="icon" href="<?php echo $this->portalUrl ?>"></a></div>
  <div class="tr_slog">
    <p id="tr_uni">The United Republic of Tanzania</p>
    <p id="tr_gms">Government Mailing System </p>
     <!-- <span class="gms-version">ver. 2.0</span> -->
  </div>
  <!-- <div id="horde-version"><?php echo $this->h($this->version) ?></div> -->
  <div id="horde-navigation">
    <?php echo $this->menu->getTree() ?>
  </div>

    <?php if ($this->logoutUrl): ?>
  
  <!-- <div class="tr_glogo"></div> -->
  
    <?php elseif ($this->loginUrl): ?>
  <div id="horde-login"><a class="icon" title="<?php echo _("Log in") ?>" href="<?php echo $this->loginUrl ?>"></a></div>
<?php endif ?>
<?php if ($this->search): ?>
  <div id="horde-search">
    <form action="<?php echo $this->searchAction ?>" method="get">
<?php foreach ($this->searchParameters as $name => $value): ?>
      <input type="hidden" name="<?php echo $this->h($name) ?>" value="<?php echo $this->h($value) ?>" />
<?php endforeach ?>
<?php if ($this->searchMenu): ?>
      <div class="horde-fake-input">
        <span id="horde-search-dropdown">
          <span class="iconImg horde-popdown"></span>
        </span>
        <input autocomplete="off" id="horde-search-input" type="text" />
      </div>
<?php else: ?>
      <input type="text" id="horde-search-input" name="searchfield" class="formGhost" title="<?php echo $this->searchLabel ?>" />
<?php endif ?>
      <input type="image" id="horde-search-icon" src="<?php echo $this->searchIcon ?>" />
    </form>
  </div>
<?php endif ?>
</div>
