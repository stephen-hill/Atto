<?php

namespace Atto\Tests\Documents;

/**
 * @Document
 * @Collection(name="users")
 */
class User
{
    /**
     * @Id
     * @Field(type='integer', unsigned=true)
     * @var integer
     */
    protected $id;

    /**
     * @Field(type='string', length='128', nullable=false)
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $name;

    /**
     * @Field(name="emails", type='array', nullable=true)
     * @var array|null
     */
    protected $emailAddresses;

    /**
     * @var boolean
     */
    protected $enabled;
    
    /**
     * @Field(default="United Kingdom")
     */
}