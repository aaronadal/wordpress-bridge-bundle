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
abstract class AbstractUser
{

    /**
     * @ORM\Id
     * @ORM\Column(name="ID", type="wp_id", length=20, nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="user_login", type="string", length=60, nullable=false)
     */
    private $username;

    /**
     * @ORM\Column(name="user_pass", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(name="user_nicename", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(name="user_email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(name="user_url", type="string", length=100, nullable=false)
     */
    private $url;

    /**
     * @ORM\Column(name="user_registered", type="datetime", nullable=false)
     */
    private $registryDate;

    /**
     * @ORM\Column(name="user_activation_key", type="string", length=255, nullable=false)
     */
    private $activationKey;

    /**
     * @ORM\Column(name="user_status", type="integer", length=11, nullable=false)
     */
    private $status = 0;

    /**
     * @ORM\Column(name="display_name", type="string", length=250, nullable=false)
     */
    private $displayName;

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
     * Gets the Username.
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Sets the Username.
     *
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Gets the Name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the Name.
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * Gets the RegistryDate.
     *
     * @return DateTimeInterface
     */
    public function getRegistryDate(): DateTimeInterface
    {
        return $this->registryDate;
    }

    /**
     * Sets the RegistryDate.
     *
     * @param DateTimeInterface $registryDate
     */
    public function setRegistryDate(DateTimeInterface $registryDate): void
    {
        $this->registryDate = $registryDate;
    }

    /**
     * Gets the ActivationKey.
     *
     * @return string
     */
    public function getActivationKey(): string
    {
        return $this->activationKey;
    }

    /**
     * Sets the ActivationKey.
     *
     * @param string $activationKey
     */
    public function setActivationKey(string $activationKey): void
    {
        $this->activationKey = $activationKey;
    }

    /**
     * Gets the Status.
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Sets the Status.
     *
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * Gets the DisplayName.
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * Sets the DisplayName.
     *
     * @param string $displayName
     */
    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }

    /**
     * Gets the Posts.
     *
     * @return AbstractPost[]|Collection
     */
    public abstract function getPosts(): Collection;

    /**
     * Sets the Posts.
     *
     * @param AbstractPost[]|Collection $posts
     */
    public abstract function setPosts(Collection $posts): void;

    /**
     * Gets the Comments.
     *
     * @return AbstractComment[]|Collection
     */
    public abstract function getComments(): Collection;

    /**
     * Sets the Comments.
     *
     * @param AbstractComment[]|Collection $comments
     */
    public abstract function setComments(Collection $comments): void;

    /**
     * Gets the Metas.
     *
     * @return AbstractUserMeta[]|Collection
     */
    public abstract function getMetas(): Collection;

    /**
     * Sets the Metas.
     *
     * @param AbstractUserMeta[]|Collection $metas
     */
    public abstract function setMetas(Collection $metas): void;

    /**
     * Gets one Meta by key.
     *
     * @param $key
     *
     * @return AbstractUserMeta|null
     */
    public function getMeta($key): ?AbstractUserMeta
    {
        foreach ($this->getMetas() as $meta) {
            if($meta->getKey() === $key) {
                return $meta;
            }
        }

        return null;
    }
}
