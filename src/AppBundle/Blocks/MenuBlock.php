<?php
/**
 * Created by PhpStorm.
 * User: alexandru.vasileniuc
 * Date: 13.04.2017
 * Time: 17:08
 */

namespace AppBundle\Blocks;


use Knp\Menu\Provider\MenuProviderInterface;
use Sonata\BlockBundle\Block\Service\MenuBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class MenuBlock extends MenuBlockService
{
    public function __construct($name, EngineInterface $templating, MenuProviderInterface $menuProvider)
    {
        parent::__construct($name, $templating, $menuProvider, ['homepageChildren' => 'Homepage Children']);
    }
}