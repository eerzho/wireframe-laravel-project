<?php

namespace App\Constants\Messages;

class ExceptionMessage
{
    const FAIL_SAVE          = 'Не удалось сохранить';
    const FAIL_UPDATE        = 'Не удалось обновить';
    const FAIL_DELETE        = 'Не удалось удалить';
    const INVALID_PASSWORD   = 'Не правильный пароль';
    const FAIL_LOGOUT        = 'Не удалось выйти';
    const UN_AUTH            = 'Авторизуйтесь';
    const EMAIL_VERIFIED     = 'Почта подтверждена';
    const EMAIL_NOT_VERIFIED = 'Почта не подтверждена';
    const INVALID_TOKEN      = 'Не правильный токен';
    const FAIL_SEND_EMAIL    = 'Не удалось отправить email';
}
