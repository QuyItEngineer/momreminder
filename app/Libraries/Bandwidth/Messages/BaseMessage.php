<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/18/18
 * Time: 11:14 AM
 */

namespace App\Libraries\Bandwidth\Messages;


use App\Libraries\Bandwidth\Exceptions\AttributeNotFoundException;
use phpDocumentor\Reflection\Types\Callable_;

class BaseMessage
{
    protected $attributes = [];

    protected $isErrorReport = false;

    protected $errorHandler = null;

    /**
     * BaseMessage constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->attributes = array_merge($this->attributes, $params);
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param $name
     * @return mixed
     * @throws AttributeNotFoundException
     * @author vuldh <vuldh@nal.vn>
     */
    public function __get($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        throw new AttributeNotFoundException("Attribute $name not found");
    }

    public function isErrorReport()
    {
        return $this->isErrorReport;
    }

    /**
     * @return $this
     * @author vuldh <vuldh@nal.vn>
     */
    public function error()
    {
        $this->isErrorReport = true;
        return $this;
    }

    /**
     * @param Callable $callback
     * @author vuldh <vuldh@nal.vn>
     * @return BaseMessage
     */
    public function setErrorHandler($callback)
    {
        $this->errorHandler = $callback;
        return $this;
    }

    /**
     * @return mixed
     * @author vuldh <vuldh@nal.vn>
     */
    public function getErrorHandler()
    {
        return $this->errorHandler;
    }
}