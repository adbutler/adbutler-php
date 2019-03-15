<?php

namespace AdButler\Utils;

/**
 * @param array $arr
 * @param array $map A map mapping resource object type to the PHP class name
 *
 * @return object mixed
 */
function instantiateRecursively($arr, &$map)
{
    $arrFields = array_filter($arr, 'is_array');
    if (!empty($arrFields)) {
        foreach ($arrFields as $field => $value) {
            $arr[$field] = key_exists('object', $value) ? instantiateRecursively($value, $map) : $value;
        }
    }
    $class = key_exists($arr['object'], $map) ? $map[$arr['object']] : null;
    return empty($class) ? $arr : new $class($arr);
}

/**
 * Indents the string by given number of space characters.
 * Default number of space characters is 0 which amounts to un-indenting the string.
 *
 * Example: (int, string) -> string
 *     str_indent(4, 'hello');    //=> '    hello'
 *     str_indent(0, '   hello'); //=> '    hello'
 *     str_indent(2, '   hello'); //=> '      hello'
 *
 * @param int $char
 * @param $str
 * @return string
 */
function str_indent($char = 0, $str)
{
    return _unlines(array_map(function ($v) use ($char) {
        return str_repeat(" ", $char) . $v;
    }, _lines($str)));
}

function stringifyBool($bool)
{
    return $bool ? 'true' : 'false';
}

function toJSON($data, $oldIndent, $newIndent)
{
    if (defined('JSON_UNESCAPED_SLASHES') && defined('JSON_UNESCAPED_UNICODE') && defined('JSON_PRETTY_PRINT')) {
        $encodedJSON = json_encode($data,
            JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        $encodedJSON = pretty_json(json_unescape_slashes(json_unescape_unicode(json_encode($data,
            JSON_NUMERIC_CHECK))));
    }
    return changeIndentationOfJSONString($encodedJSON, $oldIndent, $newIndent);
}

/**
 * Only to support pretty JSON output in PHP 5.3
 * This function can be safely removed when we drop support for PHP 5.3.x.
 *
 * Source:
 *   [1]: http://stackoverflow.com/a/24933162
 *   [2]: https://3v4l.org/XslFJ#v530
 *
 * @param $escapedJSONString
 * @return mixed
 */
function json_unescape_unicode($escapedJSONString)
{
    // Source: http://stackoverflow.com/a/24933162
    $unescapedJSONString = preg_replace_callback('/(?<!\\\\)\\\\u(\w{4})/', function ($matches) {
        return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
    }, $escapedJSONString);
    return $unescapedJSONString;
}

/**
 * Only to  pretty JSON output in PHP 5.3.x.
 * This function can be safely removed when we drop support for PHP 5.3.x.
 *
 * @param $escapedJSONString
 * @return mixed
 */
function json_unescape_slashes($escapedJSONString)
{
    return preg_replace('/\\\\\//', '/', $escapedJSONString);
}

/**
 * Only to support pretty JSON output in PHP 5.3
 * This function can be safely removed when we drop support for PHP 5.3.x.
 *
 * Source:
 *   [1]: http://stackoverflow.com/a/8014854
 *   [2]: http://snipplr.com/view/60559/prettyjson
 *
 * Modified by: Wasif Hasan Baig <baig@sparklit.com>
 *
 * @param $json
 * @return string
 */
function pretty_json($json)
{
    $result = '';
    $pos = 0;
    $strLen = strlen($json);
    $indentStr = '  ';
    $newLine = "\n";
    $prevChar = '';
    $outOfQuotes = true;

    for ($i = 0; $i <= $strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;

            // If this character is the end of an element, 
            // output a new line and indent the next line.
        } else {
            if (($char == '}' || $char == ']') && $outOfQuotes) {
                $result .= $newLine;
                $pos--;
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentStr;
                }
            }
        }

        // Add the character to the result string.
        $result .= $char;

        if ($char == ':' && $outOfQuotes) {
            $result .= ' ';
        }

        // If the last character was the beginning of an element, 
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos++;
            }

            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }

        $prevChar = $char;
    }

    return $result;
}

// Private Functions
// =============================================================================

function _lines($str)
{
    return explode("\n", $str);
}

function _unlines($arr)
{
    return join("\n", $arr);
}


function rmJSONCurlies($jsonStr)
{
    return substr(trim($jsonStr), 1, -1); // removes opening and closing curlies (curly braces)
}

/**
 * @param $jsonStr
 * @param $oldIndent
 * @param int $newIndent
 *
 * @return string
 */
function changeIndentationOfJSONString($jsonStr, $oldIndent, $newIndent = 2)
{
    $jsonLinesSansCurlies = array_filter(_lines(rmJSONCurlies($jsonStr)), function ($x) {
        return !empty($x);
    });
    $str = array_map(changeIndent($oldIndent, $newIndent), $jsonLinesSansCurlies);
    return "{\n" . _unlines($str) . "\n}";
}

/**
 * Returns the index position of the very first character in the given string.
 * Example: String -> Integer
 *      firstCharIndex("hello world"); //=> 0
 *      firstCharIndex("    hello world"); //=> 4
 * @param  $str
 * @return bool|int
 */
function firstCharIndex($str)
{
    return strpos($str, mb_substr(ltrim($str), 0, 1));
}

/**
 * Changes the left indentation of the string
 * @param  $newIndent
 * @param  $oldIndent
 * @return callable
 */
function changeIndent($oldIndent, $newIndent)
{
    return function ($str) use ($newIndent, $oldIndent) {
        return str_indent(firstCharIndex($str) * $newIndent / $oldIndent, ltrim($str));
    };
}

///**
// * @param  array  $params
// * @return string
// */
//function joinQueryParams($params) {
//    $gluedKeyVals = array_map( function($key, $val) {
//        $val = is_bool($val) ? \AdButler\Utils\stringifyBool($val) : $val;
//        return "$key=".rawurlencode($val);
//    }, array_keys($params), $params);
//    $joinedAndGluedKeyVals = join("&", $gluedKeyVals);
//    return $joinedAndGluedKeyVals;
//}


