<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastActivity = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $birthDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $moviesSeen = null;

    #[ORM\Column(nullable: true)]
    private ?int $seriesSeen = null;

    #[ORM\Column(nullable: true)]
    private ?int $badgeProgress = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Country $country = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Comment::class)]
    private Collection $comment;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Rating::class)]
    private Collection $rating;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Catalog::class)]
    private Collection $catalog;

    #[ORM\ManyToMany(targetEntity: Badge::class, inversedBy: 'users')]
    private Collection $badge;

    public function __construct()
    {
        $this->comment = new ArrayCollection();
        $this->rating = new ArrayCollection();
        $this->catalog = new ArrayCollection();
        $this->badge = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLastActivity(): ?\DateTimeImmutable
    {
        return $this->lastActivity;
    }

    public function setLastActivity(\DateTimeImmutable $lastActivity): self
    {
        $this->lastActivity = $lastActivity;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeImmutable $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getMoviesSeen(): ?int
    {
        return $this->moviesSeen;
    }

    public function setMoviesSeen(?int $moviesSeen): self
    {
        $this->moviesSeen = $moviesSeen;

        return $this;
    }

    public function getSeriesSeen(): ?int
    {
        return $this->seriesSeen;
    }

    public function setSeriesSeen(?int $seriesSeen): self
    {
        $this->seriesSeen = $seriesSeen;

        return $this;
    }

    public function getBadgeProgress(): ?int
    {
        return $this->badgeProgress;
    }

    public function setBadgeProgress(?int $badgeProgress): self
    {
        $this->badgeProgress = $badgeProgress;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment->add($comment);
            $comment->setOwner($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getOwner() === $this) {
                $comment->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRating(): Collection
    {
        return $this->rating;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->rating->contains($rating)) {
            $this->rating->add($rating);
            $rating->setOwner($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->rating->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getOwner() === $this) {
                $rating->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Catalog>
     */
    public function getCatalog(): Collection
    {
        return $this->catalog;
    }

    public function addCatalog(Catalog $catalog): self
    {
        if (!$this->catalog->contains($catalog)) {
            $this->catalog->add($catalog);
            $catalog->setOwner($this);
        }

        return $this;
    }

    public function removeCatalog(Catalog $catalog): self
    {
        if ($this->catalog->removeElement($catalog)) {
            // set the owning side to null (unless already changed)
            if ($catalog->getOwner() === $this) {
                $catalog->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Badge>
     */
    public function getBadge(): Collection
    {
        return $this->badge;
    }

    public function addBadge(Badge $badge): self
    {
        if (!$this->badge->contains($badge)) {
            $this->badge->add($badge);
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        $this->badge->removeElement($badge);

        return $this;
    }
}
