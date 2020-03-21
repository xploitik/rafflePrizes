<?php

namespace RafflePrizes\forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\StringLength;

/**
 * Class ActionEditForm
 * @package RafflePrizes\forms
 */
class AuthForm extends Form
{
    public function initialize($entity = null, $options = [])
    {
        $this->add(
            (new Text('email'))->addValidators([
                new Email([
                    'message' => 'E-mail обязателен',
                ])
            ])
        );

        $this->add(
            (new Password('password'))->addValidators([
                new StringLength([
                    'min' => 3,
                    'messageMinimum' => 'Пароль минимум 3 символа',
                ])
            ])
        );
    }
}