<?php

namespace KunstCafe\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="starting_time", type="datetime")
     */
    private $startingTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ending_time", type="datetime")
     */
    private $endingTime;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set startingTime
     *
     * @param \DateTime $startingTime
     * @return Event
     */
    public function setStartingTime($startingTime)
    {
        $this->startingTime = $startingTime;

        return $this;
    }

    /**
     * Get startingTime
     *
     * @return \DateTime 
     */
    public function getStartingTime()
    {
        return $this->startingTime;
    }

    /**
     * Set endingTime
     *
     * @param \DateTime $endingTime
     * @return Event
     */
    public function setEndingTime($endingTime)
    {
        $this->endingTime = $endingTime;

        return $this;
    }

    /**
     * Get endingTime
     *
     * @return \DateTime 
     */
    public function getEndingTime()
    {
        return $this->endingTime;
    }
}
