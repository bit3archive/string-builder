<?php

/**
 * This file is part of bit3/string-builder.
 *
 * (c) Tristan Lins <tristan@lins.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    bit3/string-builder
 * @author     Tristan Lins <tristan@lins.io>
 * @copyright  2013,2014 Tristan Lins
 * @link       https://github.com/bit3/string-builder
 * @license    https://github.com/bit3/string-builder/blob/master/LICENSE MIT
 * @filesource
 */

namespace Bit3\StringBuilder;

/**
 * StringBuilder for PHP provide string manipulation logic in an object.
 */
class StringBuilder
{
    /**
     * The current sequence.
     *
     * @var string
     */
    protected $string;

    /**
     * The current sequence encoding.
     *
     * @var string
     */
    protected $encoding;

    /**
     * Create a new string builder object.
     *
     * @param string|null $string   The initial sequence.
     * @param string|null $encoding The encoding of the sequence.
     */
    public function __construct($string = null, $encoding = 'UTF-8')
    {
        $this->string   = static::convertString($string, $encoding);
        $this->encoding = (string) $encoding;
    }

    /**
     * Set the encoding of this sequence.
     *
     * Warning: This will not convert an existing sequence!
     *
     * @param string $encoding The new encoding.
     *
     * @return StringBuilder
     */
    public function setEncoding($encoding)
    {
        $this->encoding = (string) $encoding;

        return $this;
    }

    /**
     * Convert this sequence into another encoding.
     *
     * @param string $encoding The new encoding.
     *
     * @return StringBuilder
     */
    public function changeEncoding($encoding)
    {
        $encoding       = (string) $encoding;
        $this->string   = iconv($this->encoding, $encoding, $this->string);
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Get the encoding of this sequence.
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Check if this sequence starts with a given string.
     *
     * @param string $string The sequence to search for.
     *
     * @return bool
     */
    public function startsWith($string)
    {
        $string = static::convertString($string, $this->encoding);

        return $string === $this->substring(0, (mb_strlen($string, $this->encoding) - 1))->__toString();
    }

    /**
     * Check if this sequence ends with a given string.
     *
     * @param string $string The sequence to search for.
     *
     * @return bool
     */
    public function endsWith($string)
    {
        $string = static::convertString($string, $this->encoding);

        return $string === $this->substring($this->length() - mb_strlen($string, $this->encoding))->__toString();
    }

    /**
     * Return the character at the given position in the sequence.
     *
     * @param int $index The character index.
     *
     * @return string
     * @throws \OutOfBoundsException If the index is out of bounds.
     */
    public function charAt($index)
    {
        $index = (int) $index;

        if ($index < 0 || $index >= $this->length()) {
            throw new \OutOfBoundsException();
        }

        return mb_substr($this->string, $index, 1, $this->encoding);
    }

    /**
     * Return the first occurrence of a string in the sequence.
     *
     * @param string   $string The sequence to search for.
     * @param int|null $offset The offset index to search from.
     *
     * @return int
     * @throws \OutOfBoundsException If the index is out of bounds.
     */
    public function indexOf($string, $offset = null)
    {
        $string = static::convertString($string, $this->encoding);
        $offset = $offset !== null ? (int) $offset : null;

        if ($offset !== null && ($offset < 0 || $offset >= $this->length())) {
            throw new \OutOfBoundsException();
        }

        return mb_strpos($this->string, $string, $offset, $this->encoding);
    }

    /**
     * Return the last occurrence of a string in the sequence.
     *
     * @param string   $string The sequence to search for.
     * @param int|null $offset The offset index to search from.
     *
     * @return int
     * @throws \OutOfBoundsException If the index is out of bounds.
     */
    public function lastIndexOf($string, $offset = null)
    {
        $string = static::convertString($string, $this->encoding);
        $offset = $offset !== null ? (int) $offset : null;

        if ($offset !== null && ($offset < 0 || $offset >= $this->length())) {
            throw new \OutOfBoundsException();
        }

        return mb_strrpos($this->string, $string, $offset, $this->encoding);
    }

    /**
     * Check if this sequence contains the given string.
     *
     * @param string $string The sequence to search for.
     *
     * @return bool
     */
    public function contains($string)
    {
        return $this->indexOf($string) !== false;
    }

    /**
     * Return a substring of this sequence.
     *
     * @param int $start The start index.
     * @param int $end   The end index.
     *
     * @return StringBuilder
     * @throws \OutOfBoundsException If the start or end index is out of bounds.
     */
    public function substring($start, $end = null)
    {
        $start = (int) $start;
        $end   = $end !== null ? (int) $end : null;

        if ($start < 0 || $start >= $this->length() || $end !== null && ($end < 0 || $end >= $this->length())) {
            throw new \OutOfBoundsException();
        }

        $string        =
            mb_substr($this->string, $start, $end !== null ? ($end + 1) : $this->length(), $this->encoding);
        $stringBuilder = new StringBuilder($string);
        $stringBuilder->setEncoding($this->encoding);

        return $stringBuilder;
    }

    /**
     * Return the length of this sequence.
     *
     * @return int
     */
    public function length()
    {
        return mb_strlen($this->string, $this->encoding);
    }

    /**
     * Return the byte count of this sequence.
     *
     * @return int
     */
    public function byteCount()
    {
        return strlen($this->string);
    }

    /**
     * Append a string to the sequence.
     *
     * @param string $string The sequence to append.
     *
     * @return StringBuilder
     */
    public function append($string)
    {
        $string = static::convertString($string, $this->encoding);

        $this->string .= $string;

        return $this;
    }

    /**
     * Insert a string into the sequence.
     *
     * @param int    $offset The offset index.
     * @param string $string The sequence to insert.
     *
     * @return StringBuilder
     *
     * @throws \OutOfBoundsException If the index is out of bounds.
     */
    public function insert($offset, $string)
    {
        $offset = (int) $offset;
        $string = static::convertString($string, $this->encoding);

        if ($offset < 0 || $offset >= $this->length()) {
            throw new \OutOfBoundsException();
        }

        $this->string = mb_substr($this->string, 0, $offset, $this->encoding) .
            $string .
            mb_substr($this->string, $offset, $this->length(), $this->encoding);
        return $this;
    }

    /**
     * Replace a substring by another string in this sequence.
     *
     * @param int    $start  The start index.
     * @param int    $end    The end index.
     * @param string $string The sequence to place.
     *
     * @return StringBuilder
     *
     * @throws \OutOfBoundsException If the start or end index is out of bounds.
     */
    public function replace($start, $end, $string)
    {
        $start  = (int) $start;
        $end    = (int) $end;
        $string = static::convertString($string, $this->encoding);

        if ($start < 0 || $start >= $this->length() || $end < 0 || $end >= $this->length()) {
            throw new \OutOfBoundsException();
        }

        $this->string = mb_substr($this->string, 0, $start, $this->encoding) .
            $string .
            mb_substr($this->string, ($end + 1), $this->length(), $this->encoding);
        return $this;
    }

    /**
     * Remove the characters in a substring of this sequence.
     *
     * @param int $start Start of substring.
     * @param int $end   End of substring.
     *
     * @return StringBuilder
     *
     * @throws \OutOfBoundsException If the index is out of bounds.
     */
    public function delete($start, $end)
    {
        $start = (int) $start;
        $end   = (int) $end;

        if ($start < 0 || $start >= $this->length() || $end < 0 || $end >= $this->length()) {
            throw new \OutOfBoundsException();
        }

        $this->string = mb_substr($this->string, 0, $start, $this->encoding) .
            mb_substr($this->string, ($end + 1), $this->length(), $this->encoding);
        return $this;
    }

    /**
     * Delete the character at the index, the sequence will be shorten by one.
     *
     * @param int $index The character position, starting at 0.
     *
     * @return StringBuilder
     *
     * @throws \OutOfBoundsException If the index is out of bounds.
     */
    public function deleteCharAt($index)
    {
        $index = (int) $index;
        if ($index < 0 || $index >= $this->length()) {
            throw new \OutOfBoundsException();
        }

        $this->string = mb_substr($this->string, 0, $index, $this->encoding) .
            mb_substr($this->string, ($index + 1), $this->length(), $this->encoding);
        return $this;
    }

    /**
     * Reverse the sequence.
     *
     * @return StringBuilder
     */
    public function reverse()
    {
        $length   = $this->length();
        $reversed = '';
        while ($length-- > 0) {
            $reversed .= mb_substr($this->string, $length, 1, $this->encoding);
        }

        $this->string = $reversed;
        return $this;
    }

    /**
     * Set the length of this sequence.
     *
     * If the sequence is shorter, than it will be pad with spaces.
     *
     * @param int    $newLength The new length.
     * @param string $padding   The padding sequence.
     *
     * @return StringBuilder
     */
    public function setLength($newLength, $padding = ' ')
    {
        $newLength     = (int) $newLength;
        $currentLength = $this->length();

        if ($newLength != $currentLength) {
            while ($newLength > $this->length()) {
                $this->string .= $padding;
            }
            if ($newLength < $this->length()) {
                $this->string = mb_substr($this->string, 0, $newLength, $this->encoding);
            }
        }

        return $this;
    }

    /**
     * Trim characters from the left and right side of this sequence.
     *
     * @param string|null $characters The characters to trim. Leave empty for whitespaces.
     *
     * @return StringBuilder
     */
    public function trim($characters = null)
    {
        $this->string = trim($this->string, $characters);
        return $this;
    }

    /**
     * Trim characters from the left side of this sequence.
     *
     * @param string|null $characters The characters to trim. Leave empty for whitespaces.
     *
     * @return StringBuilder
     */
    public function trimLeft($characters = null)
    {
        $this->string = ltrim($this->string, $characters);
        return $this;
    }

    /**
     * Trim characters from the right side of this sequence.
     *
     * @param string|null $characters The characters to trim. Leave empty for whitespaces.
     *
     * @return StringBuilder
     */
    public function trimRight($characters = null)
    {
        $this->string = rtrim($this->string, $characters);
        return $this;
    }

    /**
     * Return the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * Internal helper function to convert string encodings.
     *
     * @param string|StringBuilder $string         The input string.
     * @param string               $outputEncoding The output encoding.
     *
     * @return string
     */
    private static function convertString($string, $outputEncoding)
    {
        if ($string instanceof StringBuilder) {
            $inputEncoding = $string->getEncoding();
        } else {
            $inputEncoding = mb_detect_encoding((string) $string);
        }
        $string = (string) $string;
        if ($inputEncoding != $outputEncoding) {
            $string = iconv($inputEncoding, $outputEncoding, $string);
        }
        return $string;
    }
}
