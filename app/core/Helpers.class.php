<?php

class Helpers
{
    public static function debug($data)
    {
        if ($data === false || $data === null) {
            echo '<pre>';
            var_dump($data);
            echo '</pre>';
        }

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public static function getAsset($path)
    {
        return BASE_PATH . 'app/assets/' . $path;
    }

    public static function getThemeAsset($path)
    {
        return '/themes/templates/default/assets/' . $path; // TODO : Change default by current theme
    }

    public static function getMedia($path)
    {
        return BASE_PATH . $path;
    }

    public static function getAdminRoute($path)
    {
        $path = rtrim($path, '/');
        return BASE_PATH . ADMIN_PATH . '/' . $path . '/';
    }

    public static function getExternalAdminRoute($path)
    {
        return $_SERVER['HTTP_HOST'] . self::getAdminRoute($path);
    }

    public static function redirectBack()
    {
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $path = $_SERVER['HTTP_REFERER'];
            self::redirect($path);
        }
    }

    public static function redirect($path)
    {
        header('Location: ' . $path);
        exit();
    }

    public static function error500()
    {
        header('HTTP/1.1 500 Internal Server Error');
    }

    public static function error403($message = null)
    {
        if (is_array($message)) {
            $message = json_encode($message);
        }

        header('HTTP/1.1 403 Forbidden');
        die($message);
    }

    public static function error404()
    {
        $errorManager = new ErrorController();
        $errorManager->error404();
        die;
    }

    /**
     * @param $string
     * @var array $transformers contains singular to plural translation
     * @return string $string in plural
     */
    public static function renameValuePlural($string) {
        $transformers = [
            'y' => 'ies',
        ];
        if (array_key_exists(substr($string, -1), $transformers)) {
            return (substr($string, 0, -1) . $transformers[substr($string, -1)]);
        } else {
            return $string.'s';
        }
    }

    /**
     * @param string $element
     * @var array $chars contains all accent existing
     * @return string $element cleaned from accent
     */
    public static function removeAccent($element)
    {
        $chars = [
            "Š"=>"S", "š"=>"s", "Ð"=>"D", "d"=>"d", "Ž"=>"Z", "ž"=>"z", "C"=>"C", "c"=>"c","À"=>"A", "Á"=>"A", "Â"=>"A",
            "Ã"=>"A", "Ä"=>"A", "Å"=>"A", "Æ"=>"A", "Ç"=>"C", "È"=>"E", "É"=>"E","Ê"=>"E", "Ë"=>"E", "Ì"=>"I", "Í"=>"I",
            "Î"=>"I", "Ï"=>"I", "Ñ"=>"N", "Ò"=>"O", "Ó"=>"O", "Ô"=>"O","Õ"=>"O", "Ö"=>"O", "Ø"=>"O", "Ù"=>"U", "Ú"=>"U",
            "Û"=>"U", "Ü"=>"U", "Ý"=>"Y", "Þ"=>"B", "ß"=>"Ss","à"=>"a", "á"=>"a", "â"=>"a", "ã"=>"a", "ä"=>"a", "å"=>"a",
            "æ"=>"a", "ç"=>"c", "è"=>"e", "é"=>"e","ê"=>"e", "ë"=>"e", "ì"=>"i", "í"=>"i", "î"=>"i", "ï"=>"i", "ð"=>"o",
            "ñ"=>"n", "ò"=>"o", "ó"=>"o","ô"=>"o", "õ"=>"o", "ö"=>"o", "ø"=>"o", "ù"=>"u", "ú"=>"u", "û"=>"u", "ý"=>"y",
            "þ"=>"b","ÿ"=>"y", "R"=>"R", "r"=>"r"
        ];
        return strtr($element, $chars);

    }

    /**
     * @param $element
     * @param string $replaced default : -
     * @return string $element cleaned from special chars
     */
    public static function removeSpecialChar($element, $replaced = "-")
    {
        $cleaned = $element;
        $cleaned = preg_replace( '`(\\r|\\n|\\t|\/\*(.+)\*\/)`Us', '', $cleaned);
        $cleaned = preg_replace('`(\ +)`', ' ', $cleaned);
        $cleaned = preg_replace("`(\’|\=|\^|\%|\$|\+|\-|\*|_|\@|\(|\)|\!|\[|\]|\#|\ |\,|\.|\/|\'|\:|\°|\?|\"|\\\\|\®|\™)`", $replaced, $cleaned);
        $cleaned = preg_replace("`(\\{$replaced}+)`", $replaced, $cleaned);
        $cleaned = preg_replace("`({$replaced}+)`", $replaced, $cleaned);
        return trim($cleaned, $replaced);

    }

    /**
     * @param string $url
     * @return string $url combined removeAccent & removeSpecialChar
     */
    public static function slugify($url)
    {
        return strtolower(self::removeAccent(self::removeSpecialChar($url)));
    }

    /**
     * @param string $dateEnglish date
     * @var Object DateTime $dateTime
     * @var string $dateFormated contain the date from DateTime format method
     * @var array $arrayDate generated from explode and then implode with the month customized
     * @return string french date
     */
    public static function dateFrench($dateEnglish)
    {
        $dateTime = new DateTime($dateEnglish);
        $dateFormated = $dateTime->format('d / F / Y à h : i : s');
        $arrayDate = explode(' / ', $dateFormated);
        $arrayDate[1] = self::monthFrench(lcfirst($arrayDate[1]));
        return implode(' ', $arrayDate);
    }

    /**
     * @param string $englishMonth
     * @var array $monthAssociated contain all month and their traduction
     * @return string $monthAssociated at the key of $englishMonth
     */
    public static function monthFrench($englishMonth)
    {
        $monthAssociated = [
            'january' => 'janvier',
            'february' => 'février',
            'march' => 'mars',
            'april' => 'avril',
            'may' => 'mai',
            'june' => 'juin',
            'july' => 'juillet',
            'august' => 'août',
            'september' => 'septembre',
            'october' => 'octobre',
            'november' => 'novembre',
            'december' => 'decembre'
        ];
        return $monthAssociated[$englishMonth];
    }
}
