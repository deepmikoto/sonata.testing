<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sessions
 *
 * @ORM\Table(name="sessions")
 * @ORM\Entity()
 */
class Sessions
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="sess_id", type="string", length=255)
     */
    private $sessId;

    /**
     * @var string
     *
     * @ORM\Column(name="sess_data", type="blob")
     */
    private $sessData;

    /**
     * @var int
     *
     * @ORM\Column(name="sess_time", type="integer")
     */
    private $sessTime;

    /**
     * @var int
     *
     * @ORM\Column(name="sess_lifetime", type="integer")
     */
    private $sessLifetime;

    /**
     * Set sessId
     *
     * @param string $sessId
     *
     * @return Sessions
     */
    public function setSessId($sessId)
    {
        $this->sessId = $sessId;

        return $this;
    }

    /**
     * Get sessId
     *
     * @return string
     */
    public function getSessId()
    {
        return $this->sessId;
    }

    /**
     * Set sessData
     *
     * @param string $sessData
     *
     * @return Sessions
     */
    public function setSessData($sessData)
    {
        $this->sessData = $sessData;

        return $this;
    }

    /**
     * Get sessData
     *
     * @return string
     */
    public function getSessData()
    {
        return $this->sessData;
    }

    /**
     * Set sessTime
     *
     * @param integer $sessTime
     *
     * @return Sessions
     */
    public function setSessTime($sessTime)
    {
        $this->sessTime = $sessTime;

        return $this;
    }

    /**
     * Get sessTime
     *
     * @return int
     */
    public function getSessTime()
    {
        return $this->sessTime;
    }

    /**
     * Set sessLifetime
     *
     * @param integer $sessLifetime
     *
     * @return Sessions
     */
    public function setSessLifetime($sessLifetime)
    {
        $this->sessLifetime = $sessLifetime;

        return $this;
    }

    /**
     * Get sessLifetime
     *
     * @return int
     */
    public function getSessLifetime()
    {
        return $this->sessLifetime;
    }
}

