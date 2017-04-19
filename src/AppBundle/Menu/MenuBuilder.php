<?php
/**
 * Created by PhpStorm.
 * User: alexandru.vasileniuc
 * Date: 13.04.2017
 * Time: 17:48
 */

namespace AppBundle\Menu;

use Application\Sonata\PageBundle\Entity\Page;
use Application\Sonata\PageBundle\Entity\Site;
use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;
use Sonata\PageBundle\Admin\PageAdmin;
use Sonata\PageBundle\CmsManager\CmsPageManager;

class MenuBuilder
{
    private $factory;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var CmsPageManager
     */
    private $pageManager;

    /**
     * MenuBuilder constructor.
     * @param FactoryInterface $factory
     * @param CmsPageManager $pageManager
     */
    public function __construct(FactoryInterface $factory, EntityManager $em, CmsPageManager $pageManager)
    {
        $this->factory = $factory;
        $this->em = $em;
        $this->pageManager = $pageManager;
    }

    public function createHomepageChildrenMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        /** @var Page $page */
        $page = $this->pageManager->getCurrentPage();
        if ($page) {
            /** @var Site $site */
            $site = $page->getSite();
            if ($site) {
                $homepage = $this->em->getRepository(Page::class)->findOneBy([
                    'site' => $site,
                    'parent' => null,
                    'url' => '/'
                ]);
                if ($homepage) {
                    /** @var Page $child */
                    foreach ($homepage->getChildren() as $child) {
                        if ($child->getShowInMenus()) {
                           $menu->addChild($child->getName(),[
                               'uri' => $child->getUrl()
                           ]);
                        }
                    }

                }
            }


            //$menu->addChild('google', array('url' => 'http://google.ro'));
        }



        return $menu;
    }
}