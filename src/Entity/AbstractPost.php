<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author  Aarón Nadal <aaronadal.dev@gmail.com>
 *
 * @package Aaronadal\WordpressBridgeBundle\Entity
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractPost
{

    /**
     * @ORM\Id
     * @ORM\Column(name="ID", type="wp_id", length=20, nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="post_date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @ORM\Column(name="post_date_gmt", type="datetime", nullable=false)
     */
    private $dateGmt;

    /**
     * @ORM\Column(name="post_content", type="text", nullable=false)
     */
    private $content;

    /**
     * @ORM\Column(name="post_title", type="text", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(name="post_excerpt", type="text", nullable=false)
     */
    private $excerpt;

    /**
     * @ORM\Column(name="post_status", type="string", length=20, nullable=false)
     */
    private $status = 'publish';

    /**
     * @ORM\Column(name="comment_status", type="string", length=20, nullable=false)
     */
    private $commentStatus = 'open';

    /**
     * @ORM\Column(name="ping_status", type="string", length=20, nullable=false)
     */
    private $pingStatus = 'open';

    /**
     * @ORM\Column(name="post_password", type="string", length=20, nullable=false)
     */
    private $password = '';

    /**
     * @ORM\Column(name="post_name", type="string", length=200, nullable=false)
     */
    private $slug;

    /**
     * @ORM\Column(name="to_ping", type="text", nullable=false)
     */
    private $toPing = '';

    /**
     * @ORM\Column(name="pinged", type="text", nullable=false)
     */
    private $pinged = '';

    /**
     * @ORM\Column(name="post_modified", type="datetime", nullable=false)
     */
    private $modifiedDate;

    /**
     * @ORM\Column(name="post_modified_gmt", type="datetime", nullable=false)
     */
    private $modifiedDateGmt;

    /**
     * @ORM\Column(name="post_content_filtered", type="text", nullable=false)
     */
    private $contentFiltered = '';

    /**
     * @ORM\Column(name="guid", type="string", length=255, nullable=false)
     */
    private $guid;

    /**
     * @ORM\Column(name="menu_order", type="integer", length=11, nullable=false)
     */
    private $weight;

    /**
     * @ORM\Column(name="post_type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(name="post_mime_type", type="string", length=100, nullable=false)
     */
    private $mimeType;

    /**
     * @ORM\Column(name="comment_count", type="bigint", length=20, nullable=false)
     */
    private $commentCount = 0;

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
     * Gets the Date.
     *
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Sets the Date.
     *
     * @param DateTime $date
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Gets the DateGmt.
     *
     * @return DateTime
     */
    public function getDateGmt(): DateTime
    {
        return $this->dateGmt;
    }

    /**
     * Sets the DateGmt.
     *
     * @param DateTime $dateGmt
     */
    public function setDateGmt(DateTime $dateGmt)
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
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * Gets the Title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the Title.
     *
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Gets the Excerpt.
     *
     * @return string
     */
    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    /**
     * Sets the Excerpt.
     *
     * @param string $excerpt
     */
    public function setExcerpt(string $excerpt)
    {
        $this->excerpt = $excerpt;
    }

    /**
     * Gets the Status.
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Sets the Status.
     *
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * Gets the CommentStatus.
     *
     * @return string
     */
    public function getCommentStatus(): string
    {
        return $this->commentStatus;
    }

    /**
     * Sets the CommentStatus.
     *
     * @param string $commentStatus
     */
    public function setCommentStatus(string $commentStatus)
    {
        $this->commentStatus = $commentStatus;
    }

    /**
     * Gets the PingStatus.
     *
     * @return string
     */
    public function getPingStatus(): string
    {
        return $this->pingStatus;
    }

    /**
     * Sets the PingStatus.
     *
     * @param string $pingStatus
     */
    public function setPingStatus(string $pingStatus)
    {
        $this->pingStatus = $pingStatus;
    }

    /**
     * Gets the Password.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets the Password.
     *
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * Gets the Slug.
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Sets the Slug.
     *
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Gets the ToPing.
     *
     * @return string
     */
    public function getToPing(): string
    {
        return $this->toPing;
    }

    /**
     * Sets the ToPing.
     *
     * @param string $toPing
     */
    public function setToPing(string $toPing)
    {
        $this->toPing = $toPing;
    }

    /**
     * Gets the Pinged.
     *
     * @return string
     */
    public function getPinged(): string
    {
        return $this->pinged;
    }

    /**
     * Sets the Pinged.
     *
     * @param string $pinged
     */
    public function setPinged(string $pinged)
    {
        $this->pinged = $pinged;
    }

    /**
     * Gets the ModifiedDate.
     *
     * @return DateTime
     */
    public function getModifiedDate(): DateTime
    {
        return $this->modifiedDate;
    }

    /**
     * Sets the ModifiedDate.
     *
     * @param DateTime $modifiedDate
     */
    public function setModifiedDate(DateTime $modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;
    }

    /**
     * Gets the ModifiedDateGmt.
     *
     * @return DateTime
     */
    public function getModifiedDateGmt(): DateTime
    {
        return $this->modifiedDateGmt;
    }

    /**
     * Sets the ModifiedDateGmt.
     *
     * @param DateTime $modifiedDateGmt
     */
    public function setModifiedDateGmt(DateTime $modifiedDateGmt)
    {
        $this->modifiedDateGmt = $modifiedDateGmt;
    }

    /**
     * Gets the ContentFiltered.
     *
     * @return string
     */
    public function getContentFiltered(): string
    {
        return $this->contentFiltered;
    }

    /**
     * Sets the ContentFiltered.
     *
     * @param string $contentFiltered
     */
    public function setContentFiltered(string $contentFiltered)
    {
        $this->contentFiltered = $contentFiltered;
    }

    /**
     * Gets the Guid.
     *
     * @return string
     */
    public function getGuid(): string
    {
        return $this->guid;
    }

    /**
     * Sets the Guid.
     *
     * @param string $guid
     */
    public function setGuid(string $guid)
    {
        $this->guid = $guid;
    }

    /**
     * Gets the Weight.
     *
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Sets the Weight.
     *
     * @param int $weight
     */
    public function setWeight(int $weight)
    {
        $this->weight = $weight;
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
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * Gets the MimeType.
     *
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * Sets the MimeType.
     *
     * @param string $mimeType
     */
    public function setMimeType(string $mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * Gets the CommentCount.
     *
     * @return int
     */
    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    /**
     * Sets the CommentCount.
     *
     * @param int $commentCount
     */
    public function setCommentCount(int $commentCount)
    {
        $this->commentCount = $commentCount;
    }

    /**
     * Gets the Comments.
     *
     * @return Collection|AbstractComment[]
     */
    public abstract function getComments(): Collection;

    /**
     * Sets the Comments.
     *
     * @param Collection|AbstractComment[] $comments
     */
    public abstract function setComments(Collection $comments);

    /**
     * Gets the Author.
     *
     * @return AbstractUser
     */
    public abstract function getAuthor(): AbstractUser;

    /**
     * Sets the Author.
     *
     * @param AbstractUser $author
     */
    public abstract function setAuthor(AbstractUser $author);

    /**
     * Gets the Parent.
     *
     * @return AbstractPost|null
     */
    public abstract function getParent(): AbstractPost;

    /**
     * Sets the Parent.
     *
     * @param AbstractPost|null $parent
     */
    public abstract function setParent(AbstractPost $parent = null);

    /**
     * Gets the Children.
     *
     * @return Collection|AbstractPost[]
     */
    public abstract function getChildren(): Collection;

    /**
     * Gets the Metas.
     *
     * @return Collection|AbstractPostMeta[]
     */
    public abstract function getMetas(): Collection;

    /**
     * Gets one Meta by key.
     *
     * @param $key
     *
     * @return AbstractPostMeta|null
     */
    public function getMeta($key)
    {
        foreach ($this->getMetas() as $meta) {
            if($meta->getKey() === $key) {
                return $meta;
            }
        }

        return null;
    }

    /**
     * Gets the Taxonomies.
     *
     * @return Collection|AbstractTaxonomy[]
     */
    public abstract function getTaxonomies(): Collection;

    /**
     * Sets the Taxonomies.
     *
     * @param Collection|AbstractTaxonomy[] $taxonomies
     */
    public abstract function setTaxonomies(Collection $taxonomies);
}
