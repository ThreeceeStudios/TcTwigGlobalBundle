<?php

namespace Tc\Bundle\TwigGlobal\TwigGlobal;

/**
 * TwigGlobalContainerInterface
 */
interface TwigGlobalContainerInterface
{
    /**
     * @param $tag
     * @param $value
     * @param $default
     * @return mixed
     */
    public function set($tag, $value, $default);

    /**
     * @param $tag
     * @param string $default
     * @return mixed
     */
    public function get($tag, $default = '');

    /**
     * @param $tag
     * @param $value
     * @param $default
     * @param $unique
     * @return mixed
     */
    public function merge($tag, $value, $default, $unique);

    /**
     * @param $tag
     * @return bool
     */
    public function has($tag);
}
