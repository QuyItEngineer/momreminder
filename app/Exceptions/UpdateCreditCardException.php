<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 9/2/18
 * Time: 8:12 PM
 */

namespace App\Exceptions;


use Throwable;

class UpdateCreditCardException extends AppBaseException
{
    public function __construct($internalCode = self::ERROR_UPDATE_CREDIT_CARD_FAIL, string $message = null, Throwable $previous = null)
    {
        parent::__construct($internalCode, $message, $previous);
    }
}