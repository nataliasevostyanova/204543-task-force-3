<?php

namespace TaskForce\Exceptions;

/**
 * Класс-исключение проверяет можно ли открыть файл для чтения
 */
class FileOpenException extends Exception
{
    /**
     * @param string $message является обязательным
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
