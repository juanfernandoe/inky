<?php
/**
 *  MenuItemFactory.php
 *
 *
 *  @license    see LICENSE File
 *  @filename   MenuItemFactory.php
 *  @package    inky-parse
 *  @author     Thomas Hampe <github@hampe.co>
 *  @copyright  2013-2016 Thomas Hampe
 *  @date       27.02.16
 */ 


namespace Hampe\Inky\Component;


use Hampe\Inky\Inky;
use PHPHtmlParser\Dom\HtmlNode;

class MenuItemFactory extends AbstractComponentFactory
{

    const NAME = 'item';

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * <item href="{href}">{inner}</item>
     * ------------------------------
     * <th class="menu-item">
     *  <a href="{href}">{inner}</a>
     * </th>
     *
     * @param HtmlNode $element
     * @param Inky $inkyInstance
     *
     * @return HtmlNode
     */
    public function parse(HtmlNode $element, Inky $inkyInstance)
    {
        $attributes = $element->getAttributes();
        if(isset($attributes['href'])) {
            $href = $attributes['href'];
            unset($attributes['href']);
        } else {
            $href = null;
        }
        $th = $this->th($attributes);
        $this->addCssClass('menu-item', $th);
        $a = $this->node('a');
        if($href !== null) {
            $a->setAttribute('href', $href);
        }
        $this->copyChildren($element, $a);
        $th->addChild($a);

        return $th;
    }

}