<?php

namespace ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ModelBundle\Entity\Timestampable; //faz o 'import' da classe Constraints do Symfony, dando o apelido de Assert
                                                    //Este import permitirá utilizar a notação para não permitir campos nulos
                                                    //em alguns atributos

//A anotação '@ORM\Entity(repositoryClass="ModelBundle\Repository\PostRepository")' abaixo indica onde está a classe PostRepository
/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\PostRepository")
 */
class Post extends Timestampable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // a notação '@Assert\NotBlank' faz o campo do atributo não permitir valores nulos

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank
     */
    private $content;

    //Abaixo estamos fazendo o relacionamento da entidade Post com a entidade Author
    //Utilizamos a notação para fazer o relacionamento da variavel author

    /**
     * @var Author
     *
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    private $author;

//    Não precisamos mais do conteúdo abaixo, já que esta classe está herdando
//da Classe Abstrata Timestampable

//    /**
//     * @var \DateTime
//     *
//     * @ORM\Column(name="created_at", type="datetime")
//     */
//    private $createdAt;
//
//    /**
//     * @var \DateTime
//     *
//     * @ORM\Column(name="update_at", type="datetime")
//     */
//    private $updateAt;


//    /*
//
//        Precisamos que, ao criarmos nosso post, seja inserido
//        automaticamente a data de criação, e a data de atualização,
//        para isso vamos criar um método construtor em nossa entidade,
//        veja abaixo:
//
//    */

//    Uma vez importada a Classe Timestampable, não é mais necessário a existência deste construtor

//    public function __construct()  //construtor
//    {
//        $this->createdAt = new \DateTime();
//        $this->updatedAt = new \DateTime();
//    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Post
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
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

//    Como removemos os atributos createdAt e updateAt, os métodos abaixo não serão mais necessários

//    /**
//     * Set createdAt
//     *
//     * @param \DateTime $createdAt
//     *
//     * @return Post
//     */
//    public function setCreatedAt($createdAt)
//    {
//        $this->createdAt = $createdAt;
//
//        return $this;
//    }
//
//    /**
//     * Get createdAt
//     *
//     * @return \DateTime
//     */
//    public function getCreatedAt()
//    {
//        return $this->createdAt;
//    }
//
//    /**
//     * Set updateAt
//     *
//     * @param \DateTime $updateAt
//     *
//     * @return Post
//     */
//    public function setUpdateAt($updateAt)
//    {
//        $this->updateAt = $updateAt;
//
//        return $this;
//    }
//
//    /**
//     * Get updateAt
//     *
//     * @return \DateTime
//     */
//    public function getUpdateAt()
//    {
//        return $this->updateAt;
//    }

    /**
     * Set author
     *
     * @param \ModelBundle\Entity\Author $author
     *
     * @return Post
     */
    public function setAuthor(\ModelBundle\Entity\Author $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \ModelBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
