<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\Users\IUserFactory;
use App\Domain\Interfaces\Users\IUserRepository;
use App\Domain\Interfaces\IViewModel;
use App\Models\PasswordValueObject;


class CreateUserInteractor implements CreateUserInputPort
{
    public function __construct(
        private CreateUserOutputPort $output,
        private IUserRepository      $repository,
        private IUserFactory         $factory,
    ) {
    }

    public function createUser(CreateUserRequestModel $request): IViewModel
    {
        $user = $this->factory->make([
                                         'name'  => $request->getName(),
                                         'email' => $request->getEmail(),
                                     ]);

        if ($this->repository->exists($user)) {
            return $this->output->userAlreadyExists(new CreateUserResponseModel($user));
        }

        try {
            $user = $this->repository->create($user, new PasswordValueObject($request->getPassword()));
        } catch (\Exception $e) {
            return $this->output->unableToCreateUser(new CreateUserResponseModel($user), $e);
        }

        return $this->output->userCreated(
            new CreateUserResponseModel($user)
        );
    }
}
