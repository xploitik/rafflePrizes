<?php

namespace RafflePrizes\infrastructure\session;

use Phalcon\Session\Adapter\Files as PhalconSession;
use RafflePrizes\interfaces\infrastructure\session\SessionInterface;

class Session implements SessionInterface
{
    /** PhalconSession */
    protected $phalconSession;

    /**
     * Session constructor.
     * @param PhalconSession $phalconSession
     */
    public function __construct(PhalconSession $phalconSession)
    {
        $this->phalconSession = $phalconSession;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return bool
     */
    public function save(string $name, $value): bool
    {
        $this->phalconSession->set($name, $value);
        return $this->has($name);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->phalconSession->get($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return $this->phalconSession->has($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function delete(string $name): bool
    {
        $this->phalconSession->remove($name);
        return !$this->has($name);
    }
}