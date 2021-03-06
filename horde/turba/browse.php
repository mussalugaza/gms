<?php
/**
 * Turba browse.php.
 *
 * Copyright 2000-2017 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (ASL).  If you did
 * did not receive this file, see http://www.horde.org/licenses/apache.
 *
 * @author  Chuck Hagenbuch <chuck@horde.org>
 * @package Turba
 */

require_once __DIR__ . '/lib/Application.php';
Horde_Registry::appInit('turba');

/* If default source is not browsable, try one from the addressbooks pref */
if (empty($cfgSources[Turba::$source]['browse'])) {
    $addressbooks = Turba::getAddressBooks();
    foreach ($addressbooks as $source) {
        if (!empty($cfgSources[$source]['browse'])) {
            Turba::$source = $source;
            break;
        }
    }
}
#EGA Start here
if(isset($_REQUEST['q']) && preg_match("/^[.@a-zA-Z ]*$/",$_REQUEST['q'])){
        $q= filter_var($_REQUEST['q'], FILTER_SANITIZE_MAGIC_QUOTES);
        $q = filter_var($q,FILTER_SANITIZE_SPECIAL_CHARS);
        $q = filter_var($q, FILTER_SANITIZE_STRIPPED);
        $vdomain = explode('@',$GLOBALS['registry']->getAuth());
        #$vdomain="ega.go.tz";
        $vdomain = $vdomain[1];
        $cfgSources[Turba::$source]['params']['root'] = "domainName={$vdomain},o=domains,dc=gov,dc=go,dc=tz";
        $cfgSources[Turba::$source]['params']['filter'] = "&(memberOfGroup={$q})";
}

#EGA End here
$params = array(
    'addSources' => $addSources,
    'attributes' => $attributes,
    'browse_source_count' => $browse_source_count,
    'browser' => $browser,
    'cfgSources' => $cfgSources,
    'copymoveSources' => $copymoveSources,
    'conf' => $conf,
    'factory' => $injector->getInstance('Turba_Factory_Driver'),
    'history' => $injector->getInstance('Horde_History'),
    'notification' => $notification,
    'page_output' => $page_output,
    'prefs' => $prefs,
    'registry' => $registry,
    'source' => Turba::$source,
    'turba_shares' => $injector->getInstance('Turba_Shares'),
    'vars' => Horde_Variables::getDefaultVariables(),
);

$browse = new Turba_View_Browse($params);
$browse->run();
