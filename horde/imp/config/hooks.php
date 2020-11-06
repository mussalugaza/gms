<?php
/**
 * IMP Hooks configuration file.
 *
 * For more information please see the hooks.php.dist file.
 */

class IMP_Hooks
{
    /**
     * PREFERENCE INIT: Set preference values on login.
     *
     * See horde/config/hooks.php.dist for more information.
     */
    public function prefs_init($pref, $value, $username, $scope_ob)
    {
        switch ($pref) {
        case 'add_source':
            // Dynamically set the add_source preference.
            return is_null($username)
                ? $value
                : $GLOBALS['registry']->call('contacts/getDefaultShare');


        case 'search_fields':
        case 'search_sources':
            // Dynamically set the search_fields/search_sources preferences.
            if (!is_null($username)) {
                $sources = $GLOBALS['registry']->call('contacts/sources');

                if ($pref == 'search_fields') {
                    $out = array();
                    foreach (array_keys($sources) as $source) {
                        $out[$source] = array_keys($GLOBALS['registry']->call('contacts/fields', array($source)));
                    }
                } else {
                    $out = array_keys($sources);
                }

                return json_encode($out);
            }

            return $value;
        }
    }
public function compose_addr(Horde_Mail_Rfc822_Address $addr)
   {
global $injector, $registry;
//Check if password not changed for a long time
 $identity = $injector->getInstance('IMP_Identity');
$vdomain = preg_replace('|^mail\.|i', '', getenv('HTTP_HOST'));
//$vdomain ='ega.go.tz';
$vdomain = Horde_String::lower($vdomain);
$search_domains = array('sample.go.tz');
if (!in_array($vdomain, $search_domains)) {

// $from_addr = $identity->getFromAddress();
$username=$registry->getAuth();
$currentDate =  time(); // get current date
$todate = floor(strtotime(date("Y-m-d H:i:s", $currentDate))/86400);
$lastchange = $this->_params['shadowlastchange'];
$searchbase="domainName={$vdomain},o=domains,dc=gov,dc=go,dc=tz";
$searchfilter="(&(objectClass=mailuser)(mail=".$username."))";
$shadowLastChange=exec('/usr/bin/ldapsearch -x -D "cn=vmail,dc=gov,dc=go,dc=tz" -h "10.1.2.100" -w "DkyjX7hGTdtjWtUV86y7EOi7qTLbn2" -b "'.$searchbase.'" "'.$searchfilter.'" | /bin/grep shadowLastChange: | /usr/bin/awk \'{print $2}\'',$output,$return_val);

$diff=$todate-$shadowLastChange-90;
if (($shadowLastChange>0) && ($todate-$shadowLastChange>91)){
return array(
                'msg' => "Your Password was expired for $diff days, please change the password in 'Settings=>My Account=>Password' before sending email: Send Failed",
                'level' => 'bad'
                );
}
 
if ($shadowLastChange==0){
return array(
                'msg' => "Your Password was never changed, please change the password in 'Settings=>My Account=>Password' before sending email: Send Failed",
                'level' => 'bad'
                );
}
}
 //Validate email address format
  $email=$addr->mailbox.'@'.$addr->host;
 // Remove all illegal characters from email
 $email = filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate e-mail
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
return array(
                'msg' => "Recipient E-mail Address {$email} is invalid in Standard e-mail format: Send Failed",
                'level' => 'bad'
                );
}

 //Validate email address format
                $email=$addr->mailbox.'@'.$addr->host;
                // Remove all illegal characters from email
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate e-mail
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
return array(
                'msg' => "Recipient E-mail Address {$email} is invalid in Standard e-mail format: Send Failed",
                'level' => 'bad'
                );
}
$_config=array(
'hostspec'        => '10.1.2.100',
'port'            => 389,
'version'         => 3,
'tls'             => false,
'binddn'          => 'cn=vmail,dc=gov,dc=go,dc=tz',
'bindpw'          => 'DkyjX7hGTdtjWtUV86y7EOi7qTLbn2',
'basedn'          => "o=domains,dc=gov,dc=go,dc=tz",
'options'         => array(),
'user'            => array(),
'auto_reconnect'  => false,
'min_backoff'     => 1,
'current_backoff' => 1,
'x_backoff'     => 32,
'cache'           => false,
'cachettl'        => 3600
);
$param = array(
'scope'=>'sub',
'attributes'=>'cn'
);
   //validate domain name (remove ?) hii spana
$host = str_replace('?','',$addr->host);
$regexp ="/^(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/";
if (preg_match($regexp, $host)) {
// if (!filter_var('http://'.$host, FILTER_VALIDATE_URL) === false) {
//if (checkdnsrr($host, "MX")) {
//check if domain exists in LDAP
$ld = new Horde_Ldap($_config);
$result =$ld->search(null, "(&(domainName={$host}))",$param);
if($result->count()==1){

$rMail = $addr->mailbox.'@'.$addr->host;
//validate email address
if(!filter_var($rMail, FILTER_VALIDATE_EMAIL)===false){
//check if user exists in a given domain
$base="domainName={$addr->host},o=domains,dc=gov,dc=go,dc=tz";
//$user =$ld->search($base, "(&(mail={$rMail}))",$param);
$user =$ld->search($base, "(&(objectClass=top)(accountstatus=active)(mail={$rMail}))",$param);
if($user->count() < 1){
return array(
'msg' => "Recipient e-Mail {$rMail} is in-correct/disabled OR does not exist: Send failed",
'level' => 'bad'
);
}

}
}

   }
   else {
return array(
'msg' => "Domain name {$addr->host} is either in-valid, contain un-recognized characters, OR not exist",
'level' => 'bad'
);
   }

 }
}
