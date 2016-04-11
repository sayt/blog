<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProductRepository")
 * @ORM\Table(name="blog")
 */
class Blog{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    protected $szoveg;

    /**
     * @ORM\Column(type="integer")
     */
    protected $szamlalo;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="blog")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="blog")
     * @ORM\JoinColumn(name="blog", referencedColumnName="id")
     */
    private $owner;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Blog
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

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Blog
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set szoveg
     *
     * @param string $szoveg
     * @return Blog
     */
    public function setSzoveg($szoveg)
    {
        $this->szoveg = $szoveg;

        return $this;
    }

    /**
     * Get szoveg
     *
     * @return string 
     */
    public function getSzoveg()
    {
        return $this->szoveg;
    }

    /**
     * Set szamlalo
     *
     * @param integer $szamlalo
     * @return Blog
     */
    public function setSzamlalo($szamlalo)
    {
        $this->szamlalo = $szamlalo;

        return $this;
    }

    /**
     * Get szamlalo
     *
     * @return integer 
     */
    public function getSzamlalo()
    {
        return $this->szamlalo;
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\Comment $comments
     * @return Blog
     */
    public function addComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AppBundle\Entity\Comment $comments
     */
    public function removeComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set owner
     *
     * @param string $owner
     * @return Blog
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string 
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
