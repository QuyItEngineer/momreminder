<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/26/18
 * Time: 10:04 PM
 */

namespace App\Libraries\Bandwidth\Exceptions;


use Throwable;

class APIRequestException extends BandwidthException
{
    private $responseCode;
    private $responseMessage;
    private $responseCategory;

    public function __construct($responseCode, $responseMessage, $responseCategory)
    {
        parent::__construct("[Bandwidth][Error][$responseCategory] $responseMessage", 400);
        $this->responseCode = $responseCode;
        $this->responseMessage = $responseMessage;
        $this->responseCategory = $responseCategory;
    }

    /**
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @param mixed $responseCode
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }

    /**
     * @return mixed
     */
    public function getResponseMessage()
    {
        return $this->responseMessage;
    }

    /**
     * @param mixed $responseMessage
     */
    public function setResponseMessage($responseMessage)
    {
        $this->responseMessage = $responseMessage;
    }

    /**
     * @return mixed
     */
    public function getResponseCategory()
    {
        return $this->responseCategory;
    }

    /**
     * @param mixed $responseCategory
     */
    public function setResponseCategory($responseCategory)
    {
        $this->responseCategory = $responseCategory;
    }

}