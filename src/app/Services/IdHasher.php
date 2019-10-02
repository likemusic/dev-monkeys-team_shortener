<?php

namespace App\Services;

class IdHasher
{
    /**
     * @var string
     */
    private $hashChars;

    /**
     * @var ?string
     */
    private $minLength;

    public function __construct(string $hashChars, int $minLength = null)
    {
        $this->hashChars = $hashChars;
        $this->minLength = $minLength;
    }

    public function getHash(int $id)
    {
        $hashChars = $this->hashChars;
        $hashCharsCount = mb_strlen($hashChars);

        $dividend = $id;
        $divisor = $hashCharsCount;

        $reversedCode = '';
        $remainder = $dividend;

        while ($dividend > $divisor) {
            $remainder = $dividend % $divisor;
            $reversedCode .= $this->charAt($hashChars, $remainder);
            $dividend = intdiv($dividend, $divisor);
        }

        $reversedCode .= $this->charAt($hashChars, $remainder);

        $codeLength = mb_strlen($reversedCode);

        $code = ($codeLength > 1)
            ? $this->reverseStr($reversedCode)
            : $reversedCode;

        if (!$minLength = $this->minLength) {
            return $code;
        }

        if ($codeLength >= $minLength) {
            return $code;
        }

        $pad = $this->charAt($hashChars, 0);

        return $this->leftPad($code, $minLength, $pad);
    }

    private function charAt(string $str, int $index)
    {
        return mb_substr($str, $index, 1);
    }

    private function leftPad(string $str, int $length, string $pad)
    {
        $strLength = mb_strlen($str);

        if ($strLength >= $length) {
            return $str;
        }

        $diff = strlen($str) - $strLength;

        return str_pad($str, $length + $diff, $pad, STR_PAD_LEFT);
    }

    private function reverseStr(string $str)
    {
        $r = '';

        for ($i = mb_strlen($str); $i>=0; $i--) {
            $r .= mb_substr($str, $i, 1);
        }

        return $r;
    }
}
