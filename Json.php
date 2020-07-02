<?php

namespace ArturDoruch\Json;

/**
 * Wraps JSON decoding and encoding actions. Handles decoding error.
 *
 * @author Artur Doruch <arturdoruch@interia.pl>
 */
class Json
{
    private $decoded;

    /**
     * @param string $json Encoded JSON.
     * @param bool $array If true decoded JSON will be an associative array, otherwise a stdClass object.
     * @param int $options Decoding options. See json_decode() function $options parameter.
     *
     * @throws UnexpectedJsonException when given JSON is invalid.
     */
    public function __construct($json, $array = true, $options = 0)
    {
        $this->decoded = json_decode($json, $array, 512, $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new UnexpectedJsonException($json);
        }
    }

    /**
     * Gets decoded JSON.
     *
     * @return mixed
     */
    public function getDecoded()
    {
        return $this->decoded;
    }

    /**
     * Gets encoded JSON.
     *
     * @param int $options Options to format output. See json_encode() function $options parameter.
     * @param int $depth Expected recursion depth.
     *
     * @return string
     */
    public function getEncoded($options = JSON_PRETTY_PRINT, $depth = 512)
    {
        return json_encode($this->decoded, $options, $depth);
    }
}
