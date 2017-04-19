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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Request
     */
    private $request;

    /**
     * MenuBuilder constructor.
     * @param FactoryInterface $factory
     * @param EntityManager $em
     * @param RequestStack $requestStack
     */
    public function __construct(FactoryInterface $factory, EntityManager $em, RequestStack $requestStack)
    {
        $this->factory = $factory;
        $this->em = $em;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function createHomepageChildrenMenu($options)
    {
        $menu = $this->factory->createItem('root');
        if (array_key_exists('menu_class', $options)) {
            $menu->setChildrenAttribute('class', $options['menu_class']);
        }
        $host = $this->request->getHost();
        /** @var Site $site */
        $site = $this->em->getRepository(Site::class)->findOneBy([
            'host' => $host
        ]);
        if ($site) {
            $homepage = $this->em->getRepository(Page::class)->findOneBy([
                'site' => $site,
                'parent' => null,
                'url' => '/'
            ]);
            if ($homepage) {
                $menu->addChild($homepage->getName(), [
                    'uri' => $homepage->getUrl()
                ]);
                /** @var Page $child */
                foreach ($homepage->getChildren() as $child) {
                    if ($child->getShowInMenus() && $child->getEnabled()) {
                        $menu->addChild($child->getName(),[
                            'uri' => $child->getUrl(),
                        ]);
                        if (array_key_exists('children_class', $options)) {
                            $menu->getChild($child->getName())->setAttribute('class', $options['children_class']);
                        }
                    }
                }
            }
        }

        return $menu;
    }
}