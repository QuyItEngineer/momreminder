<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/25/18
 * Time: 7:38 PM
 */

namespace App\Exceptions;


use Throwable;

class ModelNotFoundException extends AppBaseException
{
    public function __construct($internalCode = self::ERROR_MODEL_NOT_FOUND, string $message = null, Throwable $previous = null)
    {
        parent::__construct($internalCode, $message, $previous);
    }

}