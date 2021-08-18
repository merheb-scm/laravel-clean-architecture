<?php

namespace Tests\Unit;

use App\Domain\Interfaces\Users\IUserEntity;
use App\Domain\Interfaces\Users\IUserFactory;
use App\Domain\Interfaces\Users\IUserRepository;
use App\Models\EmailValueObject;
use App\Models\PasswordValueObject;
use App\Domain\UseCases\CreateUser\CreateUserInteractor;
use App\Domain\UseCases\CreateUser\CreateUserOutputPort;
use App\Domain\UseCases\CreateUser\CreateUserRequestModel;
use Mockery;
use Tests\ProvidesUsers;
use Tests\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    use ProvidesUsers;

    /**
     * @dataProvider userDataProvider
     */
    public function testInteractor(array $data)
    {
        (new CreateUserInteractor(
            $this->mockCreateUserPresenter($responseModel),
            $this->mockUserRepository(exists: false),
            $this->mockUserFactory($this->mockUserEntity($data)),
        ))->createUser(
            $this->mockRequestModel($data)
        );

        $this->assertUserMatches($data, $responseModel->getUser());
    }

    private function mockUserEntity(array $data): IUserEntity
    {
        return tap(Mockery::mock(IUserEntity::class), function ($mock) use ($data) {
            $mock
                ->shouldReceive('getName')->andReturn($data['name'])
                ->shouldReceive('getEmail')->andReturn(new EmailValueObject($data['email']))
                ->shouldReceive('getPassword')->andReturn((new PasswordValueObject($data['password']))->hashed());
        });
    }

    private function mockUserFactory(IUserEntity $user): IUserFactory
    {
        return tap(Mockery::mock(IUserFactory::class), function ($mock) use ($user) {
            $mock
                ->shouldReceive('make')
                ->with(Mockery::type('array'))
                ->andReturn($user);
        });
    }

    private function mockUserRepository(bool $exists = false): IUserRepository
    {
        return tap(Mockery::mock(IUserRepository::class), function ($mock) use ($exists) {
            $mock
                ->shouldReceive('exists')
                ->with(IUserEntity::class)
                ->andReturn($exists);

            $mock
                ->shouldReceive('create')
                ->with(IUserEntity::class, Mockery::type(PasswordValueObject::class))
                ->andReturnUsing(fn($user, $password) => $user);
        });
    }

    private function mockCreateUserPresenter(&$responseModel): CreateUserOutputPort
    {
        return tap(Mockery::mock(CreateUserOutputPort::class), function ($mock) use (&$responseModel) {
            $mock
                ->shouldReceive('userCreated')
                ->with(Mockery::capture($responseModel));
        });
    }

    private function mockRequestModel(array $data): CreateUserRequestModel
    {
        return tap(Mockery::mock(CreateUserRequestModel::class), function ($mock) use ($data) {
            $mock
                ->shouldReceive('getName')->andReturn($data['name'])
                ->shouldReceive('getEmail')->andReturn($data['email'])
                ->shouldReceive('getPassword')->andReturn($data['password']);
        });
    }
}
