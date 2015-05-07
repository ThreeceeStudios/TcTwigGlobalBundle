<?php

namespace Tc\Bundle\TwigGlobal\Twig\Extension;

use Tc\Bundle\TwigGlobal\Twig\TokenParser\TwigGlobalTokenParser;
use Tc\Bundle\TwigGlobal\TwigGlobal\TwigGlobalContainerInterface;

/**
 * TwigGlobalExtension
 */
class TwigGlobalExtension extends \Twig_Extension
{
    const TWIG_GLOBAL_CONTAINER_NAME = '_tc_global';

    /**
     * @var TwigGlobalContainerInterface
     */
    protected $globalContainer;

    /**
     * @param TwigGlobalContainerInterface $globalContainer
     */
    function __construct(TwigGlobalContainerInterface $globalContainer)
    {
        $this->globalContainer = $globalContainer;
    }

    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return array(
            new TwigGlobalTokenParser()
        );
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return array(
            self::TWIG_GLOBAL_CONTAINER_NAME => $this->globalContainer
        );
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tc_twig_global';
    }
}
