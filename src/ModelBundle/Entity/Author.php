<?php

namespace ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\AuthorRepository")
 */
class Author extends Timestampable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     * @Assert\NotBlank
     */
    private $name;

    //Abaixo estamos definindo o relacionamento da entidade Author com a entidade Post
    //Estamos utilizando a notação para fazer o relacionamento com a variável posts
    //"um autor pode ter vários Posts"

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author", cascade={"remove"})
     */
    private $posts;


    /**
     * Constructor
     */
    public function __construct()
    {
        //como a classe Timestampable já possui construtor, resolvemos este problema com o trecho abaixo
        parent::__construct(); //iniciamos o construtor da classe pai

        $this->posts = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Author
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
     * Add post
     *
     * @param \ModelBundle\Entity\Post $post
     *
     * @return Author
     */
    public function addPost(\ModelBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \ModelBundle\Entity\Post $post
     */
    public function removePost(\ModelBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
