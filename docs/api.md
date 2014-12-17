Bit3\StringBuilder\StringBuilder
===============

StringBuilder for PHP provide string manipulation logic in an object.




* Class name: StringBuilder
* Namespace: Bit3\StringBuilder





Properties
----------


### $string

    protected string $string

The current sequence.



* Visibility: **protected**


### $encoding

    protected string $encoding

The current sequence encoding.



* Visibility: **protected**


Methods
-------


### __construct

    mixed Bit3\StringBuilder\StringBuilder::__construct(string|null $string, string|null $encoding)

Create a new string builder object.



* Visibility: **public**


#### Arguments
* $string **string|null** - The initial sequence.
* $encoding **string|null** - The encoding of the sequence.



### setEncoding

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::setEncoding(string $encoding)

Set the encoding of this sequence.

Warning: This will not convert an existing sequence!

* Visibility: **public**


#### Arguments
* $encoding **string** - The new encoding.



### changeEncoding

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::changeEncoding(string $encoding)

Convert this sequence into another encoding.



* Visibility: **public**


#### Arguments
* $encoding **string** - The new encoding.



### getEncoding

    string Bit3\StringBuilder\StringBuilder::getEncoding()

Get the encoding of this sequence.



* Visibility: **public**




### startsWith

    boolean Bit3\StringBuilder\StringBuilder::startsWith(string $string)

Check if this sequence starts with a given string.



* Visibility: **public**


#### Arguments
* $string **string** - The sequence to search for.



### endsWith

    boolean Bit3\StringBuilder\StringBuilder::endsWith(string $string)

Check if this sequence ends with a given string.



* Visibility: **public**


#### Arguments
* $string **string** - The sequence to search for.



### charAt

    string Bit3\StringBuilder\StringBuilder::charAt(integer $index)

Return the character at the given position in the sequence.



* Visibility: **public**


#### Arguments
* $index **integer** - The character index.



### indexOf

    integer Bit3\StringBuilder\StringBuilder::indexOf(string $string, integer|null $offset)

Return the first occurrence of a string in the sequence.



* Visibility: **public**


#### Arguments
* $string **string** - The sequence to search for.
* $offset **integer|null** - The offset index to search from.



### lastIndexOf

    integer Bit3\StringBuilder\StringBuilder::lastIndexOf(string $string, integer|null $offset)

Return the last occurrence of a string in the sequence.



* Visibility: **public**


#### Arguments
* $string **string** - The sequence to search for.
* $offset **integer|null** - The offset index to search from.



### contains

    boolean Bit3\StringBuilder\StringBuilder::contains(string $string)

Check if this sequence contains the given string.



* Visibility: **public**


#### Arguments
* $string **string** - The sequence to search for.



### substring

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::substring(integer $start, integer $end)

Return a substring of this sequence.



* Visibility: **public**


#### Arguments
* $start **integer** - The start index.
* $end **integer** - The end index.



### length

    integer Bit3\StringBuilder\StringBuilder::length()

Return the length of this sequence.



* Visibility: **public**




### byteCount

    integer Bit3\StringBuilder\StringBuilder::byteCount()

Return the byte count of this sequence.



* Visibility: **public**




### append

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::append(string $string)

Append a string to the sequence.



* Visibility: **public**


#### Arguments
* $string **string** - The sequence to append.



### insert

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::insert(integer $offset, string $string)

Insert a string into the sequence.



* Visibility: **public**


#### Arguments
* $offset **integer** - The offset index.
* $string **string** - The sequence to insert.



### replace

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::replace(integer $start, integer $end, string $string)

Replace a substring by another string in this sequence.



* Visibility: **public**


#### Arguments
* $start **integer** - The start index.
* $end **integer** - The end index.
* $string **string** - The sequence to place.



### delete

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::delete(integer $start, integer $end)

Remove the characters in a substring of this sequence.



* Visibility: **public**


#### Arguments
* $start **integer** - Start of substring.
* $end **integer** - End of substring.



### deleteCharAt

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::deleteCharAt(integer $index)

Delete the character at the index, the sequence will be shorten by one.



* Visibility: **public**


#### Arguments
* $index **integer** - The character position, starting at 0.



### reverse

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::reverse()

Reverse the sequence.



* Visibility: **public**




### setLength

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::setLength(integer $newLength, string $padding)

Set the length of this sequence.

If the sequence is shorter, than it will be pad with spaces.

* Visibility: **public**


#### Arguments
* $newLength **integer** - The new length.
* $padding **string** - The padding sequence.



### trim

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::trim(string|null $characters)

Trim characters from the left and right side of this sequence.



* Visibility: **public**


#### Arguments
* $characters **string|null** - The characters to trim. Leave empty for whitespaces.



### trimLeft

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::trimLeft(string|null $characters)

Trim characters from the left side of this sequence.



* Visibility: **public**


#### Arguments
* $characters **string|null** - The characters to trim. Leave empty for whitespaces.



### trimRight

    \Bit3\StringBuilder\StringBuilder Bit3\StringBuilder\StringBuilder::trimRight(string|null $characters)

Trim characters from the right side of this sequence.



* Visibility: **public**


#### Arguments
* $characters **string|null** - The characters to trim. Leave empty for whitespaces.



### __toString

    string Bit3\StringBuilder\StringBuilder::__toString()

Return the string representation.



* Visibility: **public**




### convertString

    string Bit3\StringBuilder\StringBuilder::convertString(string|\Bit3\StringBuilder\StringBuilder $string, string $outputEncoding)

Internal helper function to convert string encodings.



* Visibility: **private**
* This method is **static**.


#### Arguments
* $string **string|Bit3\StringBuilder\StringBuilder** - The input string.
* $outputEncoding **string** - The output encoding.


