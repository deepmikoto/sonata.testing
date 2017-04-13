<?php
/**
 * Created by PhpStorm.
 * User: alexandru.vasileniuc
 * Date: 13.04.2017
 * Time: 17:48
 */

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('google', array('url' => 'http://google.ro'));
        

        return $menu;
    }

    public function createSidebarMenu(array $options)
    {
        $menu = $this->factory->createItem('sidebar');

        if (isset($options['include_homepage']) && $options['include_homepage']) {
            $menu->addChild('Home', array('route' => 'homepage'));
        }

        $menu->addChild('google', array('url' => 'http://google.ro'));
        $menu->addChild('google1', array('url' => 'http://google.ro'));
        $menu->addChild('google2', array('url' => 'http://google.ro'));
        $menu->addChild('google3', array('url' => 'http://google.ro'));
        $menu->addChild('google4', array('url' => 'http://google.ro'));
        $menu->addChild('google5', array('url' => 'http://google.ro'));
        $menu->addChild('google6', array('url' => 'http://google.ro'));


        // ... add more children

        return $menu;
    }
}