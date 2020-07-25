<?php

declare(strict_types=1);

namespace Slownie;

class Slownie
{
    /**
     * @param null|number $key
     *
     * @return array
     */
    protected static function getCasesTable($key = null): array
    {
        $source = [
            ['złoty', 'złotych', 'złote'],
            ['tysiąc', 'tysięcy', 'tysiące'],
            ['milion', 'milionów', 'miliony'],
            ['miliard', 'miliardów', 'miliardy'],
            ['bilion', 'bilionów', 'bilony'],
            ['biliard', 'biliardów', 'biliardy'],
            ['trylion', 'trylionów', 'tryliony'],
            ['tryliard', 'tryliardów', 'tryliardy'],
            ['kwadrylion', 'kwadrylionów', 'kwadryliony'],
            ['kwadryliard', 'kwadryliardów', 'kwaryliardy'],
            ['kwintylion', 'kwintylionów', 'kwintyliony'],
            ['kwintyliard', 'kwintyliardów', 'kwintyliardy'],
            ['sekstylion', 'sekstylionów', 'sepstyliony'],
            ['sekstyliard', 'sekstyliardów', 'sekstyliardy'],
            ['septylion', 'septylionów', 'septyliony'],
            ['septyliard', 'septyliardów', 'septyliardy'],
        ];

        return !is_null($key) ? $source[$key] ?? [] : $source;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function getHundredForm(string $key): string
    {
        $source = ['', 'sto', 'dwieście', 'trzysta', 'czterysta', 'pięćset', 'sześćset', 'siedemset', 'osiemset', 'dziewięćset'];

        return $source[$key];
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function getDozenForm(string $key): string
    {
        $source = ['', 'dziesięć', 'dwadzieścia', 'trzydzieści', 'czterdzieści', 'pięćdziesiąt', 'sześćdziesiąt', 'siedemdziesiąt', 'osiemdziesiąt', 'dziewięćdziesiąt'];

        return $source[$key];
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function getUnitForm(string $key): string
    {
        $source = ['', 'jeden', 'dwa', 'trzy', 'cztery', 'pięć', 'sześć', 'siedem', 'osiem', 'dziewięć'];

        return $source[$key];
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function getTenthForm(string $key): string
    {
        $source = ['dziesięć', 'jedenaście', 'dwanaście', 'trzynaście', 'czternaście', 'piętnaście', 'szesnaście', 'siednaście', 'osiemnaście', 'dziewiętnaście'];

        return $source[$key];
    }

    /**
     * @param number|string $number
     * @param bool          $isPlnHidden
     *
     * @return string
     */
    final public static function convert($number, bool $isPlnHidden = false): string
    {
        $number = intval(preg_replace("/\s+/", '', (string) $number));

        $amountInWords = '';

        if ($number != '') {
            $lPad = '';
            $kwW = '';
            $number = (substr_count((string) $number, ',') == 0) ? $number . ',00' : $number;

            $tmp = explode(',', (string) $number);
            $ln = strlen($tmp[0]);
            $tmpA = ($ln % 3 == 0) ? (floor($ln / 3) * 3) : ((floor($ln / 3) + 1) * 3);
            for ($i = $ln; $i < $tmpA; $i++) {
                $lPad .= '0';
                $kwW = $lPad . $tmp[0];
            }
            $kwW = ($kwW == '') ? $tmp[0] : $kwW;
            $packs = (strlen($kwW) / 3) - 1;
            $pTmp = $packs;
            for ($i = 0; $i <= $packs; $i++) {
                $table = self::getCasesTable($pTmp);

                $pKw = substr($kwW, ($i * 3), 3);

                $kw_w_s = ($pKw[1] != 1) ? self::getHundredForm($pKw[0]) . ' ' . self::getDozenForm($pKw[1]) . ' ' . self::getUnitForm($pKw[2]) : self::getHundredForm($pKw[0]) . ' ' . self::getTenthForm($pKw[2]);

                if (($pKw[0] == 0) && ($pKw[2] == 1) && ($pKw[1] < 1)) {
                    $form = $table[0];
                } elseif (($pKw[2] > 1 && $pKw[2] < 5) && $pKw[1] != 1) {
                    $form = $table[2];
                } else {
                    $form = $table[1];
                }

                $amountInWords .= $kw_w_s . ' ';

                if ($pTmp != 0 || !$isPlnHidden) {
                    $amountInWords .= $form . ' ';
                }

                $pTmp--;
            }
        }

        return trim((string) preg_replace('/\s+/', ' ', $amountInWords));
    }
}
