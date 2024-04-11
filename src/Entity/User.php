<?php

namespace DevFullStack\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: '"user"'), HasLifecycleCallbacks]
class User
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[OneToMany(
        targetEntity: Order::class,
        mappedBy: 'user',
        cascade: ['persist', 'remove'],
    )]
    private Collection $order;

    #[Column]
    public DateTimeImmutable $created_at;

    #[Column]
    public DateTimeImmutable $updated_at;

    public function __construct(
        #[Column]
        public string   $first_name,
        #[Column]
        public string   $last_name,
        #[Column]
        public string   $document,
        #[Column(unique: true)]
        public string   $email,
        #[Column]
        public string   $phone_number,
        #[Column]
        public DateTime $birth_date,
    )
    {
        $this->order = new ArrayCollection();
    }

    public function addOrder(Order $order)
    {
        $this->order->add($order);
        $order->setUser($this);
    }

    /**
     * @return Collection<Order>
     */
    public function order(): Collection
    {
        return $this->order;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new DateTimeImmutable();
        $this->setUpdatedAtValue();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updated_at = new DateTimeImmutable();
    }
}