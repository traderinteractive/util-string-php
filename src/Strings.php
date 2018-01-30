<?php
/**
 * Defines \TraderInteractive\Util\Strings class.
 */

namespace TraderInteractive\Util;

/**
 * Static class with various string functions.
 */
final class Strings
{
    /**
     * Replaces the format items in a specified string with the string representation of n specified objects.
     *
     * @param string $format A composit format string
     * @param mixed  $arguments Variable number of items to format.
     *
     * @return string Returns a copy of format in which the format items have been
     *     replaced by the string representations of arg0, arg1,... argN.
     */
    public static function format(string $format, string ...$arguments) : string
    {
        foreach ($arguments as $key => $value) {
            $format = str_replace("{{$key}}", (string)$value, $format);
        }

        return $format;
    }

    /**
     * Checks if $string ends with $suffix and puts the rest of the $string in $nonSuffix.
     *
     * @param string $string The string to check
     * @param string $suffix The suffix to check for
     * @param mixed &$nonSuffix This is the part of the string that is not the suffix.
     *
     * @return bool whether the $string ended with $suffix or not.
     */
    public static function endsWith(string $string, string $suffix, &$nonSuffix = null) : bool
    {
        $suffixLength = strlen($suffix);

        if ($suffixLength === 0) {
            $nonSuffix = $string;
            return true;
        }

        if (empty($string)) {
            $nonSuffix = '';
            return false;
        }

        if (substr_compare($string, $suffix, -$suffixLength, $suffixLength) !== 0) {
            $nonSuffix = $string;
            return false;
        }

        $nonSuffix = substr($string, 0, -$suffixLength);
        return true;
    }

    /**
     * Truncates the string to the given length, with an ellipsis at the end.
     *
     * @param string $string The string to shorten.
     * @param int $maxLength The length to truncate the string to.  The result will not be longer than this, but may be
     *                       shorter.
     * @param string $suffix The string to append when truncating.  Typically this will be an ellipsis.
     *
     * @return string The truncated string with the ellipsis included if truncation occured.
     *
     * @throws \InvalidArgumentException if $maxLength is negative
     */
    public static function ellipsize(string $string, int $maxLength, string $suffix = '...') : string
    {
        if ($maxLength < 0) {
            throw new \InvalidArgumentException('$maxLength is negative');
        }

        if (strlen($string) <= $maxLength) {
            return $string;
        }

        $trimmedLength = $maxLength - strlen($suffix);
        $string = substr($string, 0, max(0, $trimmedLength));

        if ($string === '') {
            return substr($suffix, 0, $maxLength);
        }

        return $string . $suffix;
    }

    /**
     * Uppercases words using custom word delimiters.
     *
     * This is more flexible than normal php ucwords because that only treats space as a word delimiter.
     *
     * Here is an example:
     * <code>
     * <?php
     * $string = 'break-down o\'boy up_town you+me here now,this:place';
     *
     * echo String::ucwords($string);
     * // Break-Down O\'Boy Up_Town You+Me Here Now,This:Place
     *
     * echo String::ucwords($string, '- ');
     * // Break-Down O\'boy Up_town You+me Here Now,this:place
     * ?>
     * </code>
     *
     * @param string $string The string to titleize.
     * @param string $delimiters The characters to treat as word delimiters.
     *
     * @return string The titleized string.
     */
    public static function ucwords(string $string, string $delimiters = "-_+' \n\t\r\0\x0B:/,.") : string
    {
        if ($delimiters === '') {
            return $string;
        }

        return preg_replace_callback(
            '/[^' . preg_quote($delimiters, '/') . ']+/',
            function ($matches) {
                return ucfirst($matches[0]);
            },
            $string
        );
    }
}
