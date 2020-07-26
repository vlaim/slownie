<?php

declare(strict_types=1);

namespace Slownie;

class Slownie
{
    private const MAX_ALLOWED_NUMBER = 1e15;

    protected static function getPlnCasesTable(): array
    {
        return ['złoty', 'złotych', 'złote'];
    }

    /**
     * @param null|number $key
     *
     * @return array
     */
    protected static function getCasesTable($key = null): array
    {
        $source = [
            self::getPlnCasesTable(),
            ['tysiąc', 'tysięcy', 'tysiące'],
            ['milion', 'milionów', 'miliony'],
            ['miliard', 'miliardów', 'miliardy'],
            ['bilion', 'bilionów', 'bilony'],
            ['biliard', 'biliardów', 'biliardy'],
            ['trylion', 'trylionów', 'tryliony']
        ];

        return $source[$key];
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function getHundredForm($key): string
    {
        $source = ['', 'sto', 'dwieście', 'trzysta', 'czterysta', 'pięćset', 'sześćset', 'siedemset', 'osiemset', 'dziewięćset'];

        return $source[$key] ?? '';
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function getDozenForm($key): string
    {
        $source = ['', 'dziesięć', 'dwadzieścia', 'trzydzieści', 'czterdzieści', 'pięćdziesiąt', 'sześćdziesiąt', 'siedemdziesiąt', 'osiemdziesiąt', 'dziewięćdziesiąt'];


        return $source[$key] ?? '';
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function getUnitForm($key): string
    {
        $source = ['', 'jeden', 'dwa', 'trzy', 'cztery', 'pięć', 'sześć', 'siedem', 'osiem', 'dziewięć'];

        return $source[$key] ?? '';
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function getTenthForm($key): string
    {
        $source = ['dziesięć', 'jedenaście', 'dwanaście', 'trzynaście', 'czternaście', 'piętnaście', 'szesnaście', 'siednaście', 'osiemnaście', 'dziewiętnaście'];

        return $source[$key] ?? '';
    }

    /**
     * @param number|string $number
     * @param bool          $isPlnHidden
     *
     * @throws OutOfRangeException
     *
     * @return string
     */
    final public static function convert($number, bool $hideGrosze = false, bool $isPlnHidden = false): string
    {
        $grosze = explode('.', number_format(floatval($number), 2, '.', ''))[1] ?: '00';

        $number = intval(preg_replace("/\s+/", '', (string) $number));

        if ($number < 0) {
            throw OutOfRangeException::numberShouldBePositive();
        }

        if ($number > self::MAX_ALLOWED_NUMBER) {
            throw OutOfRangeException::numberIsTooBig();
        }

        $amountInWords = '';

        $lPad = '';
        $kwW = '';


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

            $hundredForm = self::getHundredForm($pKw[0]);
            $dozenForm = self::getDozenForm($pKw[1]);
            $unitForm = self::getUnitForm($pKw[2]);
            $tenthForm = self::getTenthForm($pKw[2]);

            $kwWs = ($pKw[1] != 1) ? "{$hundredForm} {$dozenForm} {$unitForm}" : "{$hundredForm} {$tenthForm}";

            if (($pKw[0] == 0) && ($pKw[2] == 1) && ($pKw[1] < 1)) {
                $form = $table[0];
            } elseif (($pKw[2] > 1 && $pKw[2] < 5) && $pKw[1] != 1) {
                $form = $table[2];
            } else {
                $form = $table[1];
            }

            $isPackEmptyString = (string) preg_replace('/\s+/', '', $kwWs);

            if ($isPackEmptyString || in_array($form, self::getPlnCasesTable())) {
                $amountInWords .= " {$kwWs}";

                if ($pTmp != 0 || !$isPlnHidden) {
                    $amountInWords .= " {$form}";
                }
            }

            $pTmp--;
        }

        if (!$hideGrosze) {
            $amountInWords .= " {$grosze}/100";
        }


        return trim((string) preg_replace('/\s+/', ' ', $amountInWords));
    }
}
