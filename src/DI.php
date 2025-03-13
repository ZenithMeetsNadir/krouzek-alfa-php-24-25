<?php

namespace App;

use App\Exception\ServiceNotFoundException;
use App\Model\Repository\AddressRepository;
use App\Model\Repository\UserRepository;
use App\Service\Connection;

final class DI {

    private static ?self $singleInstance = null;

    private array $services = [];

    public static function getInstance(): self {
        if (self::$singleInstance == null)
            self::$singleInstance = new self();

        return self::$singleInstance;
    }

    /**
     * @throws ServiceNotFoundException
     */
    public function getSingletonService(string $key): mixed {
        if (isset($this->services[$key]))
            return $this->services[$key];

        $factoryQualfName = 'create' . ucfirst($key);

        if (!method_exists($this, $factoryQualfName))
            throw new ServiceNotFoundException('Service '.$key.' not found');

        $this->services[$key] = $this->$factoryQualfName();

        return $this->services[$key];
    }

    public function createConnection(): Connection {
        return new Connection(
            'localhost',
            'alfa24',
            'root',
            ''
        );
    }

    public function userRepositoryFactory(): UserRepository {
        return new UserRepository($this->getSingletonService('connection'));
    }

    public function addressRepositoryFactory(): AddressRepository {
        return new AddressRepository($this->getSingletonService('connection'));
    }
}