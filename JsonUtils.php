<?php

namespace ArturDoruch\Json;

/**
 * @author Artur Doruch <arturdoruch@interia.pl>
 */
class JsonUtils
{
    /**
     * Wraps JSON keys and values into HTML span element with class name depend on value type,
     * in order to styling code with CSS styles.
     *
     * Define the following CSS styles to styling JSON code:
     *     span.{classPrefix}-key {}
     *     span.{classPrefix}-string {}
     *     span.{classPrefix}-integer {}
     *     span.{classPrefix}-float {}
     *     span.{classPrefix}-boolean {}
     *     span.{classPrefix}-null {}
     *
     * Code inspired by https://stackoverflow.com/a/7220510
     *
     * @param string $json The formatted JSON string.
     * @param string $classPrefix The HTML span element class prefix.
     *
     * @return string
     */
    public static function highlightSyntax(string $json, string $classPrefix = 'json'): string
    {
        $json = str_replace(['&', '<', '>'], ['&amp;', '&lt;', '&gt;'], $json);
        // ("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?
        static $regexp = '/("(?:\\\"|[^"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/';

        return preg_replace_callback($regexp, static function ($values) use ($classPrefix) {
            $type = 'integer';
            $value = $values[1];
            $semicolon = '';

            if (strpos($value, '"') === 0) {
                $value = preg_replace('/:$/', '', $value);

                if ($value !== $values[1]) {
                    $type = 'key';
                    $semicolon = ':';
                } else {
                    $type = 'string';
                }
            } elseif ($value === 'null') {
                $type = 'null';
            } elseif ($value === 'true' || $value === 'false') {
                $type = 'boolean';
            } elseif (preg_match('/\d\./', $value)) {
                $type = 'float';
            }

            return sprintf('<span class="%s-%s">%s</span>%s', $classPrefix, $type, $value, $semicolon);
        }, $json);
    }
}
