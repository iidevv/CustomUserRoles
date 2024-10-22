<?php

namespace Iidev\CustomUserRoles\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_views")
 */
class OrderViews extends \XLite\Model\AEntity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    protected $id;

    /**
     * @var \XLite\Model\Order
     *
     * @ORM\ManyToOne(targetEntity="XLite\Model\Order")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="order_id", nullable=false, onDelete="CASCADE")
     */
    protected $order;

    /**
     * @var \XLite\Model\Profile
     *
     * @ORM\ManyToOne(targetEntity="XLite\Model\Profile")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="profile_id", nullable=false, onDelete="CASCADE")
     */
    protected $profile;

    /**
     *
     * @var integer
     *
     * @ORM\Column (type="integer")
     */
    protected $date;



    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of profile
     */
    public function getProfile(): \XLite\Model\Profile
    {
        return $this->profile;
    }

    /**
     * Set the value of profile
     */
    public function setProfile(\XLite\Model\Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get the value of order
     */
    public function getOrder(): \XLite\Model\Order
    {
        return $this->order;
    }

    /**
     * Set the value of order
     */
    public function setOrder(\XLite\Model\Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}