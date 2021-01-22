<?php

    namespace App\Entity;

    use App\Repository\DocumentRepository;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass=DocumentRepository::class)
     */
    class Document
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
        private $title;

        /**
         * @ORM\Column(type="string", length=255, nullable=true)
         */
        private $path;

        /**
         * @ORM\ManyToOne(targetEntity=Messagerie::class, inversedBy="documents")
         */
        private $messages;

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getTitle(): ?string
        {
            return $this->title;
        }

        public function setTitle(?string $title): self
        {
            $this->title = $title;

            return $this;
        }

        public function getPath(): ?string
        {
            return $this->path;
        }

        public function setPath(?string $path): self
        {
            $this->path = $path;

            return $this;
        }

        public function getMessages(): ?Messagerie
        {
            return $this->messages;
        }

        public function setMessages(?Messagerie $messages): self
        {
            $this->messages = $messages;

            return $this;
        }
    }
