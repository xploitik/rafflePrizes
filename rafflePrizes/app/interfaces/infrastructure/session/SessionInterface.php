<?php

namespace RafflePrizes\interfaces\infrastructure\session;

interface SessionInterface
{
    /**
     * @param string $name
     * @param mixed $value
     * @return bool
     */
    public function save(string $name, $value): bool;

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name);

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param string $name
     * @return bool
     */
    public function delete(string $name): bool;
}