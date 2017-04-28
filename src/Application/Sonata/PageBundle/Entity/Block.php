<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\PageBundle\Entity;


use AppBundle\Entity\TagCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use Sonata\PageBundle\Entity\BaseBlock as BaseBlock;

/**
 * Class Block
 * @package Application\Sonata\PageBundle\Entity
 */
class Block extends BaseBlock
{
    use Translatable;

    /**
     * @var int $id
     */
    protected $id;

    /**
     * @var TagCollection
     */
    protected $tagCollection;

    public function __construct()
    {
        parent::__construct();
        $this->tagCollection = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add tagCollection
     *
     * @param \AppBundle\Entity\TagCollection $tagCollection
     *
     * @return Block
     */
    public function addTagCollection(TagCollection $tagCollection)
    {
        $tagCollection->setBlock($this);
        $this->tagCollection[] = $tagCollection;

        return $this;
    }

    /**
     * Remove tagCollection
     *
     * @param \AppBundle\Entity\TagCollection $tagCollection
     */
    public function removeTagCollection(TagCollection $tagCollection)
    {
        $this->tagCollection->removeElement($tagCollection);
    }

    /**
     * Get tagCollection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTagCollection()
    {
        return $this->tagCollection;
    }
}
