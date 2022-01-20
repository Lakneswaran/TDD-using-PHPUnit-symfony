<?php

namespace App\Entity;

use App\Repository\BookingsRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingsRepository::class)]
class Bookings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
        

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToOne(inversedBy: 'bookings', targetEntity: Room::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $room;

      

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $startDate;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $endDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRoom(): ?room
    {
        return $this->Room;
    }

    public function setRoom(?room $room): self
    {
        $this->Room = $room;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }


    
    public function checkTime(DateTime $start, DateTime $end): bool
    {
        $diffInterval = $end->diff($start);
        $diffDay = $diffInterval->d;
        $diffMonth = $diffInterval->m;
        $diffYear = $diffInterval->y;
        $diffHours = $diffInterval->h;
        $diffMinutes = $diffInterval->i;

        $time = ($diffHours * 60) + $diffMinutes;

        if($diffDay == 0 && $diffMonth == 0 && $diffYear == 0 && $time >= 0 && $time <= 240){

        return true;

        }
        return false;
    }

}
