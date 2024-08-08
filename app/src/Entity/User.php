<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a user entity in the system.
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    /**
     * @var int|null The unique identifier of the user.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var string|null The data associated with the user.
     *
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $data = null;

    /**
     * Gets the unique identifier of the user.
     *
     * @return int|null The unique identifier of the user.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets the unique identifier of the user.
     *
     * @param int $id The unique identifier of the user.
     * @return $this
     */
    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the data associated with the user.
     *
     * @return string|null The data associated with the user.
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * Sets the data associated with the user.
     *
     * @param string $data The data associated with the user.
     * @return $this
     */
    public function setData(string $data): static
    {
        $this->data = $data;

        return $this;
    }
}
