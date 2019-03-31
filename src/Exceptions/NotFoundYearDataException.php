<?php
/**
 * Created by PhpStorm.
 * User: natz
 * Date: 19. 3. 1
 * Time: 오전 9:26
 */

namespace Korean\Holiday\Exceptions;


class NotFoundYearDataException extends \Exception
{
    protected $code = 404;
    protected $message = "Not found this year. Supported 2015 ~ ";
}