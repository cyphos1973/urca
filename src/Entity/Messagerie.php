<?php

namespace App\Entity;

use App\Repository\MessagerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessagerieRepository::class)
 */
class Messagerie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_sended;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_received;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="messages", cascade={"persist" })
     */
    private $documents;

    public function __construct()
    {
        $this->document = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getDateSended(): ?\DateTimeInterface
    {
        return $this->date_sended;
    }

    public function setDateSended(?\DateTimeInterface $date_sended): self
    {
        $this->date_sended = $date_sended;

        return $this;
    }

    public function getDateReceived(): ?\DateTimeInterface
    {
        return $this->date_received;
    }

    public function setDateReceived(?\DateTimeInterface $date_received): self
    {
        $this->date_received = $date_received;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $user): self
    {
        $this->users = $user;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setMessages($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getMessages() === $this) {
                $document->setMessages(null);
            }
        }

        return $this;
    }

}
