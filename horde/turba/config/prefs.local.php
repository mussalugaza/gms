<?php
/**
 * See horde/config/prefs.php for documentation on the structure of this file.
 *
 * IMPORTANT: DO NOT EDIT THIS FILE!
 * Local overrides MUST be placed in pref.local.php or pref.d/.
 * If the 'vhosts' setting has been enabled in Horde's configuration, you can
 * use prefs-servername.php.
 */
 $_prefs['from_addr']['hook'] = true;
 $_prefs['fullname']['hook'] = true;

$prefGroups['addressbooks'] = array(
    'column' => _("Address Books"),
    'label' => _("Address Books"),
    'desc' => _("Choose which address books to use."),
    'members' => array('default_dir'),
);

$prefGroups['sync'] = array(
    'column' => _("Address Books"),
    'label' => _("Synchronization Preferences"),
    'desc' => _("Choose which address books to use for synchronization with external devices."),
    'members' => array('sync_books', 'activesync_no_multiplex'),
);

$prefGroups['columns'] = array(
    'column' => _("Display Preferences"),
    'label' => _("Column Preferences"),
    'desc' => _("Select which fields to display in the address lists."),
    'members' => array('columnselect'),
);

$prefGroups['display'] = array(
    'column' => _("Display Preferences"),
    'label' => _("Display"),
    'desc' => _("Select view to display by default and paging preferences."),
    'members' => array('initial_page', 'maxpage', 'perpage'),
);

$prefGroups['format'] = array(
    'column' => _("Display Preferences"),
    'label' => _("Name Format"),
    'desc' => _("Select which format to display names."),
    'members' => array('name_format', 'name_sort'),
);

// Address books use for synchronization
$_prefs['sync_books'] = array(
    'value' => 'a:0:{}',
    'type' => 'multienum',
    'enum' => array(),
    'desc' => _("Select the address books that should be used for synchronization with external devices:"),
    'on_init' => function($ui) {
        $enum = array();
        $sync_books = @unserialize($GLOBALS['prefs']->getValue('sync_books'));
        if (empty($sync_books)) {
            $GLOBALS['prefs']->setValue('sync_books', serialize(array(Turba::getDefaultAddressbook())));
        }
        foreach (Turba::getAddressBooks() as $key => $val) {
            if (!empty($val['map']['__uid']) &&
                !empty($val['browse'])) {
                $enum[$key] = $val['title'];
            }
        }
        $ui->prefs['sync_books']['enum'] = $enum;
    },
    'on_change' => function() {
        if ($GLOBALS['conf']['activesync']['enabled'] && !$GLOBALS['prefs']->getValue('activesync_no_multiplex')) {
            try {
                $sm = $GLOBALS['injector']->getInstance('Horde_ActiveSyncState');
                $sm->setLogger($GLOBALS['injector']->getInstance('Horde_Log_Logger'));
                $devices = $sm->listDevices($GLOBALS['registry']->getAuth());
                foreach ($devices as $device) {
                    $sm->removeState(array(
                        'devId' => $device['device_id'],
                        'id' => Horde_Core_ActiveSync_Driver::CONTACTS_FOLDER_UID,
                        'user' => $GLOBALS['registry']->getAuth()
                    ));
                }
                $GLOBALS['notification']->push(_("All state removed for your ActiveSync devices. They will resynchronize next time they connect to the server."));
            } catch (Horde_ActiveSync_Exception $e) {
                $GLOBALS['notification']->push(_("There was an error communicating with the ActiveSync server: %s"), $e->getMessage(), 'horde.error');
            }
        }
    }
);

// @todo We default to using multiplex since that is the current behavior
// For Turba 5 we should default to separate.
$_prefs['activesync_no_multiplex'] = array(
    'type' => 'checkbox',
    'desc' => _("Support separate address books?"),
    'value' => 0
);

// Columns selection widget
$_prefs['columnselect'] = array(
    'type' => 'special',
    'handler' => 'Turba_Prefs_Special_Columnselect'
);

// Columns to be displayed in Browse and Search results, with entries
// for the columns displayed for each address book.  Separate address
// book stanzas with \n and columns with \t. The "name" column is
// currently always displayed first and so cannot be modified here.
// Double quotes MUST be used as in the example.
$_prefs['columns'] = array(
    'value' => "localsql\temail"
);

// user preferred sorting column
// serialized array of hashes containing 'field' and 'ascending' keys
$_prefs['sortorder'] = array(
    'value' => 'a:1:{i:0;a:2:{s:5:"field";s:8:"lastname";s:9:"ascending";b:1;}}'
);

// number of maximum pages and items per page
$_prefs['maxpage'] = array(
    'value' => 10,
    'type' => 'number',
    'desc' => _("Maximum number of pages"),
);

$_prefs['perpage'] = array(
    'value' => 20,
    'type' => 'number',
    'desc' => _("Number of items per page"),
);

// the page to display.  Either 'browse.php' or 'search.php'
$_prefs['initial_page'] = array(
    'value' => 'search.php',
    'type' => 'enum',
    'desc' => _("View to display by default:"),
    'enum' => array(
        'browse.php' => _("Address Book Listing"),
        'search.php' => _("Search")
    )
);

// the format to display names.  Either 'last_first' or 'first_last'
$_prefs['name_format'] = array(
    'value' => 'first_last',
    'type' => 'enum',
    'desc' => _("Select the format used to <em>display</em> names:"),
    'enum' => array(
        'last_first' => _("\"Lastname, Firstname\" (ie. Doe, John)"),
        'first_last' => _("\"Firstname Lastname\"  (ie. John Doe)"),
        'none' => _("no formatting")
    )
);

// the format to sort names.  Either 'last_first' or 'first_last'
$_prefs['name_sort'] = array(
    'value' => 'first_last',
    'type' => 'enum',
    'desc' => _("Select the format used to <em>sort</em> names:"),
    'enum' => array(
        'last_first' => _("\"Lastname, Firstname\" (ie. Doe, John)"),
        'first_last' => _("\"Firstname Lastname\"  (ie. John Doe)"),
        'none' => _("no formatting")
    )
);

// Default directory
$_prefs['default_dir'] = array(
    //'value' => '',
    'value' => 'localsql',
    'type' => 'enum',
    'enum' => array(),
    'desc' => _("This will be the default address book when adding or importing contacts."),
    'on_init' => function($ui) {
        $enum = array();
        foreach (Turba::getAddressBooks(Horde_Perms::EDIT) as $key => $info) {
            $enum[$key] = $info['title'];
        }
        $ui->prefs['default_dir']['enum'] = $enum;
    },
    'on_change' => function() {
        $source = $GLOBALS['prefs']->getValue('default_dir');
        $GLOBALS['injector']
            ->getInstance('Turba_Factory_Driver')
            ->create($source)
            ->setDefaultShare($source);
    },
);

// preference for holding any preferences-based addressbooks.
$_prefs['prefbooks'] = array(
    'value' => ''
);

// Personal contact.
$_prefs['own_contact'] = array(
    // The format is 'source_name;contact_id'.
    'value' => ''
);
