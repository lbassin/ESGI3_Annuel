<?php
class Hash
{
    /**
     * Generate parsed password
     * @param string $sPassword clear password
     * @var array $aOptions the cost of the algorythm
     * @return string hashed password
     * how to use : Hash::generate('password');
     */
    static function generate($sPassword)
    {
        $aOptions = [
            'cost' => 11
        ];
        return password_hash($sPassword, PASSWORD_BCRYPT, $aOptions);
    }
    /**
     * Generate parsed password
     * @param string $sPassword clear password
     * @param string $sHash hashed password
     * @return true if the password is verified
     * how to use : Hash::check('password', 'hashedPassword');
     */
    static function check($sPassword, $sHash)
    {
        return (password_verify($sPassword, $sHash) === true) ? true : false ;
    }
}
