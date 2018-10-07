<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 9/2/18
 * Time: 8:07 PM
 */

namespace App\Exceptions;


use Throwable;

class ChargeException extends AppBaseException
{
    public function __construct($internalCode = self::ERROR_CHARGE_FAIL, string $message = null, Throwable $previous = null)
    {
        parent::__construct($internalCode, $message, $previous);
    }
}