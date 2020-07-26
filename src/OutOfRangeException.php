<?php


namespace Slownie;

class OutOfRangeException extends \Exception
{
    public static function numberShouldBePositive(): OutOfRangeException
    {
        throw new self('Provided number should be positive');
    }

    public static function numberIsTooBig(): OutOfRangeException
    {
        throw new self('Provided number is too big');
    }
}
