<?php

namespace Tc\Bundle\TwigGlobal\TwigGlobal;

/**
 * TwigGlobalContainer
 */
class TwigGlobalContainer implements TwigGlobalContainerInterface
{

    /**
     * @var array
     */
    protected $globals = array();

    /**
     * @param $tag
     * @param $value
     * @param bool $default
     * @return void
     */
    public function set($tag, $value, $default = false)
    {
        if (!$default || $this->has($tag) === false) {
            $this->globals[$tag] = $value;
        }
    }

    /**
     * @param $tag
     * @param mixed $default
     * @return string
     */
    public function get($tag, $default = false)
    {
        return $this->has($tag) ? $this->globals[$tag] : $default;
    }

    /**
     * @param $tag
     * @return bool
     */
    public function has($tag)
    {
        return isset($this->globals[$tag]);
    }

    /**
     * @param $tag
     * @param $value
     * @param $default
     * @param $unique
     * @return mixed
     */
    public function merge($tag, $value, $default, $unique)
    {
        if ($this->has($tag)) {
            if (is_array($this->get($tag))) {
                if (!is_array($value)) {
                    $value = array($value);
                }
                $value = array_merge($this->get($tag), $value);
                $this->set($tag, $value);
            } else {
                if (!is_array($value)) {
                    $this->set($tag, $this->get($tag).$value);
                }
            }
        } else {
            $this->set($tag, $value);
        }
    }
}
