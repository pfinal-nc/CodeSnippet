<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: person.proto

namespace Test;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>test.Person</code>
 */
class Person extends \Google\Protobuf\Internal\Message
{
    /**
     *姓名
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    protected $name = '';
    /**
     *年龄
     *
     * Generated from protobuf field <code>int32 age = 2;</code>
     */
    protected $age = 0;
    /**
     *性别
     *
     * Generated from protobuf field <code>bool sex = 3;</code>
     */
    protected $sex = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     * @type string $name
     *          姓名
     * @type int $age
     *          年龄
     * @type bool $sex
     *          性别
     * }
     */
    public function __construct($data = NULL)
    {
        \GPBMetadata\Person::initOnce();
        parent::__construct($data);
    }

    /**
     *姓名
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *姓名
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     *年龄
     *
     * Generated from protobuf field <code>int32 age = 2;</code>
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     *年龄
     *
     * Generated from protobuf field <code>int32 age = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setAge($var)
    {
        GPBUtil::checkInt32($var);
        $this->age = $var;

        return $this;
    }

    /**
     *性别
     *
     * Generated from protobuf field <code>bool sex = 3;</code>
     * @return bool
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     *性别
     *
     * Generated from protobuf field <code>bool sex = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setSex($var)
    {
        GPBUtil::checkBool($var);
        $this->sex = $var;

        return $this;
    }

}

