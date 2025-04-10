<?php

namespace App;

use App\Exception\ServiceNotFoundException;
use App\Model\Entity\Contact;
use App\Model\Repository\AddressRepository;
use App\Model\Repository\ContactRepository;
use App\Model\Repository\UserRepository;
use App\Model\VolatileQuery;
use App\Service\Connection;
use App\Service\LinkGenerator;
use App\Service\Message;
use App\Service\OriginInteraction;
use App\Service\Redirect;
use App\Service\Router;

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

    private function createConnection(): Connection {
        return new Connection(
            'localhost',
            'alfa24',
            'root',
            ''
        );
    }

    private function createLinkGenerator(): LinkGenerator {
        return new LinkGenerator();
    }

    private function createRedirect(): Redirect {
        $redirect = new Redirect();
        $redirect->setVolatileQuery(new VolatileQuery());
        return $redirect;
    }

    private function createRouter(): Router {
        return new Router();
    }

    private function createMessage(): Message {
        return new Message();
    }

    private function createOriginInteraction(): OriginInteraction {
        return new OriginInteraction();
    }

    private function createUserRepository(): UserRepository {
        return new UserRepository($this);
    }

    private function createAddressRepository(): AddressRepository {
        return new AddressRepository($this);
    }

    private function createContactRepository(): ContactRepository {
        return new ContactRepository($this);
    }

    public function contactFactory(): Contact {
        return new Contact($this->getSingletonService('userRepository'));
    }
}