<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/16/18
 * Time: 11:13 PM
 */

namespace App\Libraries\Bandwidth\Exceptions;


use Throwable;

class ValidationException extends BandwidthException
{
    private $errors;

    public function __construct($errors, int $code = 0, Throwable $previous = null)
    {
        $message = "Data invalid";
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }


}