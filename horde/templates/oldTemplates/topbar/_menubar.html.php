<div id="horde-head">
<?php echo $this->renderPartial('subbar') ?>
   <div id="horde-logo"><a class="icon" href="<?php echo $this->portalUrl ?>"></a></div>
  <div class="tr_slog">
    <p id="tr_uni">The United Republic of Tanzania</p>
    <p id="tr_gms">Government Mailing System </p>
  </div>
  <div id="horde-navigation">
<?php echo $this->menu->getTree() ?>
  </div>
<?php if ($this->logoutUrl): ?>
  
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
      <input type="text" id="horde-search-input" name="searchfield" class="formGhost" title="<?php echo $this->h($this->searchLabel) ?>" />
<?php endif ?>
      <input type="image" id="horde-search-icon" src="<?php echo $this->searchIcon ?>" />
    </form>
  </div>
<?php endif ?>
</div>
