<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\CreateUserType;
use App\DTO\CreateUserDTO;
use App\Utils\FormErrorHelper;
use App\Service\UserService;

/**
 * UserController handles user-related actions including fetching, creating, and deleting users.
 */
class UserController extends AbstractController
{
    private UserRepository $userRepository;
    private FormFactoryInterface $formFactory;
    private UserService $userService;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository The repository for managing user entities.
     * @param FormFactoryInterface $formFactory The form factory service for creating forms.
     * @param UserService $userService The service for handling user-related business logic.
     */
    public function __construct(UserRepository $userRepository, FormFactoryInterface $formFactory, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->userService = $userService;
    }

    /**
     * Fetches all users and renders them in the user list view.
     *
     * @param Request $request The request object.
     * @return Response The rendered view with user data and form.
     */
    #[Route('/user', methods: ['GET'])]
    public function fetchUser(Request $request): Response
    {
        $users = $this->userService->getAllUsers();
        $form = $this->formFactory->create(CreateUserType::class);

        return $this->render('user.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Creates a new user based on form submission and data transfer object.
     *
     * @param Request $request The request object containing form data.
     * @return Response The response indicating success or failure of user creation.
     */
    #[Route('/user', methods: ['POST'])]
    public function createUser(Request $request): Response
    {
        $form = $this->formFactory->create(CreateUserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();

                $createUserDTO = new CreateUserDTO(
                    $data['firstname'],
                    $data['lastname'],
                    $data['address']
                );

                try {
                    $this->userService->createUser($createUserDTO);
                    return new Response('User created successfully.', Response::HTTP_CREATED);
                } catch (\Exception $e) {
                    return new Response('Error creating user: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else {
                $errors = FormErrorHelper::getFormErrors($form);
                return new Response('Invalid data: ' . implode(', ', $errors), Response::HTTP_BAD_REQUEST);
            }
        }
        return new Response(
            'Invalid form submission',
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Deletes a user based on the provided ID.
     *
     * @param Request $request The request object containing the user ID.
     * @return Response The response indicating success or failure of user deletion.
     */
    #[Route('/user', methods: ['DELETE'])]
    public function deleteUser(Request $request): Response
    {
        $id = $request->query->get('id');

        if (!$id) {
            return new Response('Missing user ID.', Response::HTTP_BAD_REQUEST);
        }

        $user = $this->userService->findUserById((int)$id);

        if (!$user) {
            return new Response('User not found.', Response::HTTP_NOT_FOUND);
        }

        try {
            $this->userService->deleteUser($user);
            return new Response('User deleted successfully.', Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new Response('Error deleting user: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
