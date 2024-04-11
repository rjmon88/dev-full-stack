<?php

namespace DevFullStack\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: '"order"'), HasLifecycleCallbacks]
class Order
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'order')]
    public readonly User $user;

    #[Column]
    public DateTimeImmutable $created_at;

    #[Column]
    public DateTimeImmutable $updated_at;

    public function __construct(
//        #[Column]
//        public string   $user_id,
        #[Column]
        public string   $description,
        #[Column]
        public int      $quantity,
        #[Column]
        public float    $price,
    )
    {
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
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