<?php

namespace RafflePrizes\utils;

class ErrorMap
{
    public const USER_SERVICE_EMPTY_NAME = 'не заполнено имя';
    public const USER_SERVICE_EMPTY_PASSWORD = 'не заполнен пароль';
    public const USER_SERVICE_EMPTY_EMAIL = 'не заполнена почта';
    public const USER_SERVICE_EXIST_EMAIL = 'пользователь с такой почтой уже есть';

    public const AUTH_ERROR = 'email или пароль неверны';
    public const REGISTER_ERROR = 'зарегистрироваться не удалось';
    //TODO: move other file
    public const REGISTER_SUCCESS = 'Успешно зарегистрировались. Необходимо авторизация';
}