<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Model;

use Bridit\ExpertSenderApi\Model\SubscribersGetResponse\SubscriberProperty;

/**
 * Subscriber's data
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SubscriberData
{
    /**
     * @var int ID
     */
    private $id;

    /**
     * @var string e-mail address
     */
    private $email;

    /**
     * @var string Firstname
     */
    private $firstname;

    /**
     * @var string Lastname
     */
    private $lastname;

    /**
     * @var string IP
     */
    private $ip;

    /**
     * @var string Vendor
     */
    private $vendor;

    /**
     * @var SubscriberProperty[]|iterable Properties
     */
    private $properties;

    /**
     * Constructor
     *
     * @param int    $id         ID
     * @param string $firstname  Firstname
     * @param string $lastname   Lastname
     * @param string $ip         IP
     * @param string $vendor     Vendor
     * @param string $email
     * @param SubscriberProperty[]|iterable $properties Properties
     */
    public function __construct(
        int $id,
        string $firstname,
        string $lastname,
        string $ip,
        string $vendor,
        string $email,
        iterable $properties
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->ip = $ip;
        $this->vendor = $vendor;
        $this->properties = $properties;
        $this->email = $email;
    }

    /**
     * Get ID
     *
     * @return int ID
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get firstname
     *
     * @return string Firstname
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Get lastname
     *
     * @return string Lastname
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Get IP
     *
     * @return string IP
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Get vendor
     *
     * @return string Vendor
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get properties
     *
     * @return SubscriberProperty[]|iterable Properties
     */
    public function getProperties(): iterable
    {
        return $this->properties;
    }
}
