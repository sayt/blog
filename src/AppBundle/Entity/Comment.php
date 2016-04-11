<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProductRepository")
 * @ORM\Table(name="comment")
 */
class Comment{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
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
     * @Assert\Email()
     * @ORM\Column(type="string", length=100)
     */
    protected $email;

    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="comments")
     * @ORM\JoinColumn(name="blog", referencedColumnName="id")
     */
    protected $blog;

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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * Set email
     *
     * @param string $email
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set blog
     *
     * @param \AppBundle\Entity\Blog $blog
     * @return Comment
     */
    public function setBlog(\AppBundle\Entity\Blog $blog = null)
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * Get blog
     *
     * @return \AppBundle\Entity\Blog 
     */
    public function getBlog()
    {
        return $this->blog;
    }
}
