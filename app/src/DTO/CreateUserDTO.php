<?php

namespace App\DTO;

/**
 * Data Transfer Object (DTO) for creating a user.
 */
class CreateUserDTO
{
    /**
     * @var string The first name of the user.
     */
    private string $firstname;

    /**
     * @var string The last name of the user.
     */
    private string $lastname;

    /**
     * @var string The address of the user.
     */
    private string $address;

    /**
     * CreateUserDTO constructor.
     *
     * @param string $firstname The first name of the user.
     * @param string $lastname The last name of the user.
     * @param string $address The address of the user.
     */
    public function __construct(string $firstname, string $lastname, string $address)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->address = $address;
    }

    /**
     * Gets the first name of the user.
     *
     * @return string The first name of the user.
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Sets the first name of the user.
     *
     * @param string $firstname The first name of the user.
     * @return void
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * Gets the last name of the user.
     *
     * @return string The last name of the user.
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Sets the last name of the user.
     *
     * @param string $lastname The last name of the user.
     * @return void
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * Gets the address of the user.
     *
     * @return string The address of the user.
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Sets the address of the user.
     *
     * @param string $address The address of the user.
     * @return void
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
}
