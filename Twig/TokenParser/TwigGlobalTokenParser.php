<?php

namespace Tc\Bundle\TwigGlobal\Twig\TokenParser;

use Tc\Bundle\TwigGlobal\Twig\Node\TwigGlobalNode;
use Twig_Token;
use Twig_TokenParser;

/**
 * TwigGlobalTokenParser
 */
class TwigGlobalTokenParser extends Twig_TokenParser
{
    const METHOD_GET = 'GET';
    const METHOD_SET = 'SET';
    const METHOD_MERGE = 'MERGE';

    /**
     * @param Twig_Token $token
     * @return TwigGlobalNode
     * @throws \Twig_Error_Syntax
     */
    public function parse(Twig_Token $token)
    {
        $parser = $this->parser;
        $stream = $parser->getStream();
        $method = false;
        $default = false;
        $value = null;
        $unique = false;

        $name = $stream->expect(Twig_Token::NAME_TYPE)->getValue();

        $operator = $stream->nextIf(Twig_Token::OPERATOR_TYPE);

        if ($operator) {

            if ($operator->getValue() === '=') {
                $method = self::METHOD_SET;
            } elseif ($operator->getValue() === '~') {
                $method = self::METHOD_MERGE;
            }
            $value = $parser->getExpressionParser()->parseExpression();

            $next = $stream->next();
            if ($next->getType() !== Twig_Token::BLOCK_END_TYPE) {
                if ($next->getValue() === 'default') {
                    $default = true;
                } elseif ($next->getValue() === 'unique') {
                    $unique = true;
                }
                $next = $stream->next();
                if ($next->getType() !== Twig_Token::BLOCK_END_TYPE) {
                    if ($next->getValue() === 'default') {
                        $default = true;
                    } elseif ($next->getValue() === 'unique') {
                        $unique = true;
                    }
                    $stream->expect(Twig_Token::BLOCK_END_TYPE);
                }
            }

        } else {
            $method = self::METHOD_GET;
            $stream->expect(Twig_Token::BLOCK_END_TYPE);
        }

        $attributes = array(
            'method' => $method,
            'default' => $default,
            'unique' => $unique
        );

        return new TwigGlobalNode($name, $value, $token->getLine(), $this->getTag(), $attributes);
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'global';
    }
}
