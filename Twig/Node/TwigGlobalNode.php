<?php

namespace Tc\Bundle\TwigGlobal\Twig\Node;

use Tc\Bundle\TwigGlobal\Twig\Extension\TwigGlobalExtension;
use Tc\Bundle\TwigGlobal\Twig\TokenParser\TwigGlobalTokenParser;
use Twig_Compiler;
use Twig_Node;
use Twig_Node_Expression;

/**
 * TwigGlobalNode
 */
class TwigGlobalNode extends Twig_Node
{
    /**
     * @param array $name
     * @param Twig_Node_Expression $value
     * @param int $line
     * @param null $tag
     * @param array $attributes
     */
    public function __construct($name, $value, $line, $tag = null, $attributes = array())
    {
        $nodes = array();
        if ($value instanceof Twig_Node_Expression) {
            $nodes['value'] = $value;
        }
        parent::__construct($nodes, array_merge(array('name' => $name), $attributes), $line, $tag);
    }

    /**
     * @param Twig_Compiler $compiler
     */
    public function compile(Twig_Compiler $compiler)
    {
        switch ($this->getAttribute('method')) {
            case TwigGlobalTokenParser::METHOD_GET:
                $this->compileMethodGet($compiler);
                break;
            case TwigGlobalTokenParser::METHOD_SET:
                $this->compileMethodSet($compiler);
                break;
            case TwigGlobalTokenParser::METHOD_MERGE:
                $this->compileMethodMerge($compiler);
                break;
        }
    }

    protected function compileMethodGet(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write(
                'echo $context[\''.TwigGlobalExtension::TWIG_GLOBAL_CONTAINER_NAME.'\']->get(\''.$this->getAttribute(
                    'name'
                ).'\' '
            )
            ->raw(");\n");
    }

    protected function compileMethodSet(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write(
                '$context[\''.TwigGlobalExtension::TWIG_GLOBAL_CONTAINER_NAME.'\']->set(\''.$this->getAttribute(
                    'name'
                ).'\', '
            )
            ->subcompile($this->getNode('value'))
            ->write(', '.($this->getAttribute('default') === true ? 'true' : 'false'))
            ->raw(");\n");
    }

    protected function compileMethodMerge(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write(
                '$context[\''.TwigGlobalExtension::TWIG_GLOBAL_CONTAINER_NAME.'\']->merge(\''.$this->getAttribute(
                    'name'
                ).'\', '
            )
            ->subcompile($this->getNode('value'))
            ->write(', '.($this->getAttribute('default') === true ? 'true' : 'false'))
            ->write(', '.($this->getAttribute('unique') === true ? 'true' : 'false'))
            ->raw(");\n");
    }
}
