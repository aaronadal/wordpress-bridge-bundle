<?php

namespace Aaronadal\WordpressBridgeBundle\Shortcode;


use Aaronadal\WordpressBridgeBundle\Exception\DuplicatedShortcodeException;

/**
 * @author Aarón Nadal <aaronadal.dev@gmail.com>
 */
class ShortcodeParser
{

    private $shortcodes = [];

    /**
     * Adds a new ShortcodeInterface.
     *
     * @param ShortcodeInterface $shortcode
     *
     * @throws DuplicatedShortcodeException
     */
    public function addShortcode(ShortcodeInterface $shortcode)
    {
        if(isset($this->shortcodes[$shortcode->getShortcode()])) {
            throw new DuplicatedShortcodeException(
                'Another shortcode with the name "' . $shortcode->getShortcode() . '" is already defined.'
            );
        }

        $this->shortcodes[$shortcode->getShortcode()] = $shortcode;
    }

    /**
     * Removes a ShortcodeInterface.
     *
     * @param ShortcodeInterface $shortcode
     */
    public function removeShortcode(ShortcodeInterface $shortcode)
    {
        unset($this->shortcodes[$shortcode->getShortcode()]);
    }

    /**
     * @return ShortcodeInterface[]
     */
    public function getShortcodes()
    {
        return $this->shortcodes;
    }

    /**
     * @param $name
     *
     * @return ShortcodeInterface|null
     */
    public function getShortcode($name)
    {
        return $this->shortcodes[$name] ?? null;
    }

    /**
     * Returns the names of the registered ShortcodeInterfaces
     *
     * @return string[]
     */
    public function getShortcodeNames()
    {
        return array_map(
            function(ShortcodeInterface $shortcode) {
                return $shortcode->getShortcode();
            },
            $this->getShortcodes()
        );
    }

    /**
     * @return string
     */
    protected function getShortcodesRegex()
    {
        $shortcodeNames = $this->getShortcodeNames();
        $shortcodeRegex = join('|', array_map('preg_quote', $shortcodeNames));

        return '\\['                            // Opening bracket
               . '(\\[?)'                       // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
               . "($shortcodeRegex)"            // 2: Shortcode name
               . '(?![\\w-])'                   // Not followed by word character or hyphen
               . '('                            // 3: Unroll the loop: Inside the opening shortcode tag
               . '[^\\]\\/]*'                   // Not a closing bracket or forward slash
               . '(?:' . '\\/(?!\\])'           // A forward slash not followed by a closing bracket
               . '[^\\]\\/]*'                   // Not a closing bracket or forward slash
               . ')*?' . ')' . '(?:' . '(\\/)'  // 4: Self closing tag ...
               . '\\]'                          // ... and closing bracket
               . '|' . '\\]'                    // Closing bracket
               . '(?:' . '('                    // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
               . '[^\\[]*+'                     // Not an opening bracket
               . '(?:' . '\\[(?!\\/\\2\\])'     // An opening bracket not followed by the closing shortcode tag
               . '[^\\[]*+'                     // Not an opening bracket
               . ')*+' . ')' . '\\[\\/\\2\\]'   // Closing shortcode tag
               . ')?' . ')' . '(\\]?)';         // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
    }

    /**
     * Parses the shortcodes in the provided string.
     *
     * @param string $content
     *
     * @return string
     */
    public function parseShortcodes($content)
    {
        if(count($this->shortcodes) === 0 || strpos($content, '[') === false) {
            return $content;
        }

        $regex = $this->getShortcodesRegex();

        return preg_replace_callback("/$regex/s", [$this, 'parseShortcode'], $content);
    }

    /**
     * @param array $match
     *
     * @return string
     */
    public function parseShortcode($match)
    {
        if($match[1] == '[' && $match[6] == ']') {
            return substr($match[0], 1, -1);
        }

        $tag        = $match[2];
        $shortcode  = $this->getShortcode($tag);
        $attributes = $this->parseAttributes($match[3]);

        $result = $shortcode->renderShortcode($attributes, $match[5] ?? null);

        return $match[1] . $result . $match[6];
    }

    /**
     * @param string $rawAttributes
     *
     * @return ShortcodeAttributes
     */
    protected function parseAttributes($rawAttributes)
    {
        $atts = [];

        $pattern       = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
        $rawAttributes = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $rawAttributes);
        if(preg_match_all($pattern, $rawAttributes, $match, PREG_SET_ORDER)) {
            foreach($match as $m) {
                if(!empty($m[1])) {
                    $atts[strtolower($m[1])] = stripcslashes($m[2]);
                }
                else if(!empty($m[3])) {
                    $atts[strtolower($m[3])] = stripcslashes($m[4]);
                }
                else if(!empty($m[5])) {
                    $atts[strtolower($m[5])] = stripcslashes($m[6]);
                }
                else if(isset($m[7]) and strlen($m[7])) {
                    $atts[] = stripcslashes($m[7]);
                }
                else if(isset($m[8])) {
                    $atts[] = stripcslashes($m[8]);
                }
            }
        }
        else {
            $atts = ltrim($rawAttributes);
        }

        return new ShortcodeAttributes($atts);
    }
}
