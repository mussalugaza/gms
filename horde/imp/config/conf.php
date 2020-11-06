<?php
/* CONFIG START. DO NOT CHANGE ANYTHING IN OR AFTER THIS LINE. */
// $Id: 48bf0b4cc99e7941b4432a29e70e145b8d654cc7 $
$conf['user']['allow_view_source'] = true;
$conf['server']['server_list'] = 'none';
$conf['compose']['use_vfs'] = true;
$conf['compose']['link_attachments'] = false;
$conf['compose']['attach_size_limit'] = 0;
$conf['compose']['attach_count_limit'] = 0;
//$conf['compose']['reply_limit'] = 200000;
$conf['compose']['reply_limit'] = 0;
$conf['compose']['ac_threshold'] = 3;
$conf['compose']['htmlsig_img_size'] = 30000;
$conf['pgp']['keylength'] = 0;
$conf['maillog']['driver'] = 'history';
//$conf['sentmail']['driver'] = 'Null';
$conf['sentmail']['params']['threshold'] = 60;
$conf['sentmail']['params']['limit_period'] = 24;
$conf['sentmail']['params']['table'] = 'imp_sentmail';
$conf['sentmail']['params']['driverconfig'] = 'horde';
$conf['sentmail']['driver'] = 'Sql';
$conf['contactsimage']['backends'] = array('IMP_Contacts_Avatar_Addressbook');
$conf['tasklist']['use_tasklist'] = true;
$conf['notepad']['use_notepad'] = true;
/* CONFIG END. DO NOT CHANGE ANYTHING IN OR BEFORE THIS LINE. */
