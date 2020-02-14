<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author  Aarón Nadal <aaronadal.dev@gmail.com>
 *
 * @package Aaronadal\WordpressBridgeBundle\Entity
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractComment
{

    /**
     * @ORM\Id
     * @ORM\Column(name="comment_ID", type="wp_id", length=20, nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="comment_author", type="text", nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(name="comment_author_email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(name="comment_author_url", type="string", length=200, nullable=false)
     */
    private $url;

    /**
     * @ORM\Column(name="comment_author_IP", type="string", length=100, nullable=false)
     */
    private $ip;

    /**
     * @ORM\Column(name="comment_date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @ORM\Column(name="comment_date_gmt", type="datetime", nullable=false)
     */
    private $dateGmt;

    /**
     * @ORM\Column(name="comment_content", type="text", nullable=false)
     */
    private $content;

    /**
     * @ORM\Column(name="comment_karma", type="integer", length=11, nullable=false)
     */
    private $karma = 0;

    /**
     * @ORM\Column(name="comment_approved", type="string", length=20, nullable=false)
     */
    private $approved = '1';

    /**
     * @ORM\Column(name="comment_agent", type="string", length=255, nullable=false)
     */
    private $agent = '';

    /**
     * @ORM\Column(name="comment_type", type="string", length=20, nullable=false)
     */
    private $type = '';

    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    /**
     * Gets the Id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the Author.
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Sets the Author.
     *
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * Gets the Email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets the Email.
     *
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Gets the Url.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Sets the Url.
     *
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * Gets the Ip.
     *
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Sets the Ip.
     *
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * Gets the Date.
     *
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Sets the Date.
     *
     * @param DateTimeInterface $date
     */
    public function setDate(DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    /**
     * Gets the DateGmt.
     *
     * @return DateTimeInterface
     */
    public function getDateGmt(): DateTimeInterface
    {
        return $this->dateGmt;
    }

    /**
     * Sets the DateGmt.
     *
     * @param DateTimeInterface $dateGmt
     */
    public function setDateGmt(DateTimeInterface $dateGmt): void
    {
        $this->dateGmt = $dateGmt;
    }

    /**
     * Gets the Content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Sets the Content.
     *
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Gets the Karma.
     *
     * @return int
     */
    public function getKarma(): int
    {
        return $this->karma;
    }

    /**
     * Sets the Karma.
     *
     * @param int $karma
     */
    public function setKarma(int $karma): void
    {
        $this->karma = $karma;
    }

    /**
     * Gets the Approved.
     *
     * @return string
     */
    public function getApproved(): string
    {
        return $this->approved;
    }

    /**
     * Sets the Approved.
     *
     * @param string $approved
     */
    public function setApproved(string $approved): void
    {
        $this->approved = $approved;
    }

    /**
     * Gets the Agent.
     *
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * Sets the Agent.
     *
     * @param string $agent
     */
    public function setAgent(string $agent): void
    {
        $this->agent = $agent;
    }

    /**
     * Gets the Type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the Type.
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Gets the Parent.
     *
     * @return AbstractComment
     */
    public abstract function getParent(): ?AbstractComment;

    /**
     * Sets the Parent.
     *
     * @param AbstractComment $parent
     */
    public abstract function setParent(AbstractComment $parent): void;

    /**
     * @return Collection|AbstractComment[]
     */
    public abstract function getChildren(): Collection;

    /**
     * @return Collection|AbstractCommentMeta[]
     */
    public abstract function getMetas(): Collection;

    /**
     * Gets one Meta by key.
     *
     * @param $key
     *
     * @return AbstractCommentMeta|null
     */
    public function getMeta($key): ?AbstractCommentMeta
    {
        foreach ($this->getMetas() as $meta) {
            if($meta->getKey() === $key) {
                return $meta;
            }
        }

        return null;
    }

    /**
     * Gets the Post.
     *
     * @return AbstractPost
     */
    public abstract function getPost(): AbstractPost;

    /**
     * Sets the Post.
     *
     * @param AbstractPost $post
     */
    public abstract function setPost(AbstractPost $post): void;

    /**
     * Gets the User.
     *
     * @return AbstractUser|null
     */
    public abstract function getUser(): ?AbstractUser;

    /**
     * Sets the User.
     *
     * @param AbstractUser|null $user
     */
    public abstract function setUser(?AbstractUser $user): void;
}
