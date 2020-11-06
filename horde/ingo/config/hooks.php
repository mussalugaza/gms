<?php
/**
 * Ingo Hooks configuration file.
 *
 * THE HOOKS PROVIDED IN THIS FILE ARE EXAMPLES ONLY.  DO NOT ENABLE THEM
 * BLINDLY IF YOU DO NOT KNOW WHAT YOU ARE DOING.  YOU HAVE TO CUSTOMIZE THEM
 * TO MATCH YOUR SPECIFIC NEEDS AND SYSTEM ENVIRONMENT.
 *
 * For more information please see the horde/config/hooks.php.dist file.
 *
 * $Id: fdf1f95f36a8b0c339f61ac27badcdce094a0388 $
 */

class Ingo_Hooks
{
    /**
     * Returns the username/password needed to connect to the transport
     * backend.
     *
     * @param string $driver  The driver name (array key from backends.php).
     *
     * @return mixed  If non-array, uses Horde authentication credentials
                      (DEFAULT). Otherwise, an array with the following keys
     *                (non-existent keys will use default values):
     *  - euser: (string; SIEVE ONLY) For the sieve driver, the effective
     *           user to use.
     *  - password: (string) Password.
     *  - username: (string) User name.
     */
//    public function transport_auth($driver)
//    {
//        switch ($driver) {
//        case 'foo':
//            // Example #1: Use full Horde username for password.
//            return array(
//                'username' => $GLOBALS['registry']->getAuth(null)
//            );
//
//            // Example #2: Use IMP password/username.
//            $ob = $GLOBALS['registry']->call('mail/imapOb');
//            return array(
//                'password' => $ob->getParam('password'),
//                'username' => $ob->getParam('username')
//            );
//        }
//
//        // DEFAULT: Use hordeauth (identical to not defining hook at all).
//        return true;
//    }


    /**
     * Set the default addresses used for the vacation module.
     *
     * @param string $user  The username.
     * @param array $value  The default/current value.
     *
     * @return array  A list of vacation addresses.
     */
//    public function vacation_addresses($user = null, $value = null)
//    {
//        // Example #1: User has 2 vacation addresses.
//        return array($user . '@example.com', $user . '@foobar.com');
//
//        // Example #2: Keep user-supplied values, return defaults only
//        return is_array($value) && count($array)
//            ? $value
//            : array($user . '@example.com', $user . '@foobar.com');
//    }
     public function transport_auth($driver)
    {
        switch ($driver) {
        case 'timsieved':
            // Example #1: Use full Horde username for password.
            return array(
                'username' => $GLOBALS['registry']->getAuth(null)
            );

            // Example #2: Use IMP password/username.
            $ob = $GLOBALS['registry']->call('mail/imapOb');
            return array(
                'password' => $ob->getParam('password'),
                'username' => $ob->getParam('username')
            );
        }

        // DEFAULT: Use hordeauth (identical to not defining hook at all).
        return true;
    }
}
