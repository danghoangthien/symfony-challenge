<?php

namespace App\Service;

use App\DTO\CreateUserDTO;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * UserService handles the business logic for user-related operations.
 */
class UserService
{
    private UserRepository $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository The repository for managing user entities.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Creates a new user using the provided data transfer object (DTO).
     *
     * @param CreateUserDTO $createUserDTO The data transfer object containing user data.
     * @return void
     */
    public function createUser(CreateUserDTO $createUserDTO): void
    {
        // Create and save a new User entity using the DTO
        $user = new User();
        $user->setData($createUserDTO->getFirstname() . ' - ' . $createUserDTO->getLastname() . ' - ' . $createUserDTO->getAddress());
        $this->userRepository->save($user);
    }

    /**
     * Finds a user by their ID.
     *
     * @param int $id The ID of the user to find.
     * @return User|null The user entity if found, or null if not found.
     */
    public function findUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * Deletes a user entity.
     *
     * @param User $user The user entity to delete.
     * @return void
     * @throws EntityNotFoundException If the user is not found.
     */
    public function deleteUser(User $user): void
    {
        if (!$user) {
            throw new EntityNotFoundException('User not found.');
        }

        $this->userRepository->delete($user);
    }

    /**
     * Fetches all users.
     *
     * @return User[] An array of User entities.
     */
    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }
}
