<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translation;

/**
 * TagTranslation
 *
 * @ORM\Table(name="tag_translation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagTranslationRepository")
 */
class TagTranslation
{
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TagTranslation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

