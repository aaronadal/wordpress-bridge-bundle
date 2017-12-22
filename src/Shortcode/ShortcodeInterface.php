<?php

namespace Aaronadal\WordpressBridgeBundle\Shortcode;


/**
 * @author Aarón Nadal <aaronadal.dev@gmail.com>
 */
interface ShortcodeInterface
{

    /**
     * Returns the name of the shortcode.
     *
     * @return string
     */
    public function getShortcode();

    /**
     * Sets the parser. It allows you to parse shortcodes inside your shortcodes.
     *
     * @param ShortcodeParser
     */
    public function setShortcodeParser(ShortcodeParser $parser);

    /**
     * Renders the shortcode and returns the HTML.
     *
     * @param ShortcodeAttributes $atts     The shortcode attributes.
     * @param string              $content  The content of the shortcode.
     *
     * @return string
     */
    public function renderShortcode(ShortcodeAttributes $atts, $content);
}
