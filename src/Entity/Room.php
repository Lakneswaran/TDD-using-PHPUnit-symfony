<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'boolean', options:["default" => false])]
    private $onlyForPremiumMembers;

    #[ORM\OneToOne(mappedBy: 'room', targetEntity: Bookings::class, cascade: ['persist', 'remove'])]
    private $bookings;

 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOnlyForPremiumMembers(): ?bool
    {
        return $this->onlyForPremiumMembers;
    }

    public function setOnlyForPremiumMembers(bool $onlyForPremiumMembers): self
    {
        $this->onlyForPremiumMembers = $onlyForPremiumMembers;

        return $this;
    }

    public function getBookings(): ?Bookings
    {
        return $this->bookings;
    }

    public function setBookings(Bookings $bookings): self
    {
        // set the owning side of the relation if necessary
        if ($bookings->getRoom() !== $this) {
            $bookings->setRoom($this);
        }

        $this->bookings = $bookings;

        return $this;
    }  

    function canBook(User $user) {
        return ($this->getOnlyForPremiumMembers() && $user->getPremiumMember() || !$this->getOnlyForPremiumMembers());
    }

  
}
