<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Model\TransactionalPostRequest;

/**
 * Receiver of transactional message
 *
 * @see https://sites.google.com/a/expertsender.com/api-documentation/methods/messages/send-transactional-messages
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
final class Receiver
{
    /**
     * @var int|null Subscriber ID
     */
    private $id;

    /**
     * @var string|null Subscriber email
     */
    private $email;

    /**
     * @var string|null Md5 of subscriber email
     */
    private $emailMd5;

    /**
     * @var int|null List ID
     */
    private $listId;

    /**
     * @var string BCC
     */
    private $bcc;

    /**
     * Create receiver with ID as identifier
     *
     * @param int      $id     Subscriber ID
     * @param int|null $listId List ID
     *
     * @param string|null $bcc
     * @return static Receiver of message
     */
    public static function createWithId(int $id, int $listId = null, $bcc = null)
    {
        return new static($id, null, null, $listId, $bcc);
    }

    /**
     * Create receiver with email as identifier
     *
     * @param string   $email  Subscriber email
     * @param int|null $listId List ID
     *
     * @param null|string $bcc
     * @return static Receiver of message
     */
    public static function createWithEmail(string $email, int $listId = null, $bcc = null)
    {
        return new static(null, $email, null, $listId, $bcc);
    }

    /**
     * Create receiver with md5 email as identifier
     *
     * @param string   $emailMd5 Md5 of subscriber email
     * @param int|null $listId   List ID
     *
     * @param null|string $bcc
     * @return static Receiver of message
     */
    public static function createWithEmailMd5(string $emailMd5, int $listId = null, $bcc = null)
    {
        return new static(null, null, $emailMd5, $listId, $bcc);
    }

    /**
     * Constructor
     *
     * @param int|null    $id       Subscriber ID
     * @param string|null $email    Subscriber Email
     * @param string|null $emailMd5 Md5 of subscriber email
     * @param int|null    $listId   List ID
     * @param null|string $bcc
     */
    private function __construct(int $id = null, string $email = null, string $emailMd5 = null, int $listId = null, $bcc = null)
    {
        // not check anything, because constructor is private and nobody can create invalid object
        $this->id = $id;
        $this->email = $email;
        $this->listId = $listId;
        $this->emailMd5 = $emailMd5;
        $this->bcc = $bcc;
    }

    /**
     * @return string
     */
    public function getBcc(): ?string
    {
        return $this->bcc;
    }

    /**
     * Get ID
     *
     * @return int|null ID
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get email
     *
     * @return null|string Email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Get Md5 of email
     *
     * @return null|string Md5 of email
     */
    public function getEmailMd5(): ?string
    {
        return $this->emailMd5;
    }

    /**
     * Get list ID
     *
     * @return int|null List ID
     */
    public function getListId(): ?int
    {
        return $this->listId;
    }
}
