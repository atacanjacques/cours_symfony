<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
*/

class Post
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
  * @ORM\Column(name="title", type="string")
  */
  private $title;

  /**
  * @var DateTime
  *
  * @ORM\Column(type="datetime")
  */
  private $createdAt;

  /**
  * @var string
  *
  * @ORM\Column(type="text")
  */
  private $content;

  public function __construct()
  {
    $this->createdAt = new \Datetime();
  }
  /**
  * Get the value of Id
  *
  * @return integer
  */
  public function getId()
  {
    return $this->id;
  }

  /**
  * Get the value of Title
  *
  * @return string
  */
  public function getTitle()
  {
    return $this->title;
  }

  /**
  * Set the value of Title
  *
  * @param string title
  *
  * @return self
  */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
  * Get the value of Created At
  *
  * @return DateTime
  */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
  * Set the value of Created At
  *
  * @param DateTime createdAt
  *
  * @return self
  */
  public function setCreatedAt(DateTime $createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
  * Get the value of Content
  *
  * @return string
  */
  public function getContent()
  {
    return $this->content;
  }

  /**
  * Set the value of Content
  *
  * @param string content
  *
  * @return self
  */
  public function setContent($content)
  {
    $this->content = $content;

    return $this;
  }

}
