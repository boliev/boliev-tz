<?php

namespace Test\Lib;

class Translator
{
    /**
     * @var array
     */
    private $translates;

    /**
     * Translator constructor.
     *
     * @param array $translates
     */
    public function __construct(array $translates)
    {
        $this->translates = $translates;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function trans(string $key)
    {
        if (isset($this->translates[$key])) {
            if (is_array($this->translates[$key])) {
                return $this->translates[$key][array_rand($this->translates[$key])];
            }

            return $this->translates[$key];
        }

        return $key;
    }
}
