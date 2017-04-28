<?php
/**
 * Created by PhpStorm.
 * User: alexandru.vasileniuc
 * Date: 28.04.2017
 * Time: 10:20
 */

namespace AppBundle\Blocks;


use Application\Sonata\PageBundle\Entity\Block;
use Doctrine\ORM\EntityManager;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

trait EntityManagerAwareBlockTrait
{
    
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct($name, EngineInterface $templating, EntityManager $entityManager)
    {
        parent::__construct($name, $templating);
        $this->entityManager = $entityManager;
    }

    /**
     * @param BlockInterface $block
     * @return BlockInterface
     */
    public function refreshBlock(BlockInterface $block)
    {
        return $this->entityManager->getRepository(Block::class)->find($block);
    }
}