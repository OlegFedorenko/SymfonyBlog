<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $postedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $postHead;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min="50", max="1000")
     */
    private $postBody;

    public function __construct()
    {
        $this->postedAt = new \DateTime();
        $this->noLink = false;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostedAt(): ?\DateTimeInterface
    {
        return $this->postedAt;
    }

    public function setPostedAt(\DateTimeInterface $postedAt): self
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    public function getPostHead(): ?string
    {
        return $this->postHead;
    }

    public function setPostHead(string $postHead): self
    {
        $this->postHead = $postHead;

        return $this;
    }

    public function getPostBody(): ?string
    {
        return $this->postBody;
    }

    public function setPostBody(string $postBody): self
    {
        $this->postBody = $postBody;

        return $this;
    }

    public function getShortBodyCheat(): ?string
    {
        if (mb_strlen($this->postBody) <= 255)
        {
            return $this->postBody;
        }

        $short = mb_substr($this->postBody, 0, 255);
        $spacePosition = mb_strrpos($short, ' ');

        if ($spacePosition === false)
        {
            return $short.'...';
        }

        $short = mb_substr($short, 0, $spacePosition);

        return $short.'...';
    }

    public function getShortBody():? string
    {
        $aPosition = mb_strpos($this->postBody, "\n");
        return $short = mb_substr($this->postBody, 0, $aPosition);

    }
}
