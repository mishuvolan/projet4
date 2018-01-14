<?php
namespace OC\ShopBundle\WebService;
use Doctrine\ORM\EntityManager;

class WebService
{
    protected $em;
    private $maxCapacity;
    private $maxPurchaseItem;
    public function __construct(EntityManager $entityManager, $maxCapacity, $maxPurchaseItem)
    {
        $this->em               = $entityManager;
        $this->maxCapacity      = (int) $maxCapacity;
        $this->maxPurchaseItem  = (int) $maxPurchaseItem;
    }
    /**
     * 
     *
     * @param \DateTime $date
     * @param $booking
     * @return bool
     */

    public function checkCapacity(\DateTime $date, $booking)
    {
        $totalTicketForThisDate = $this->getNumberTicketFor($date);
        return ( ($totalTicketForThisDate + $booking) > $this->maxCapacity ) ? false : true;
    }
    /**
     *
     *
     * @param \DateTime $date
     * @return int
     */
    public function getRemainingBooking(\DateTime $date)
    {
        $totalBookingForThisDate = $this->getNumberBookingFor($date);
        return (int) ( ($this->maxCapacity - $totalBookingForThisDate) < $this->maxPurchaseItem ) ? ($this->maxCapacity - $totalBookingForThisDate) : $this->maxPurchaseItem;
    }
    /**
     * 
     *
     * @param \DateTime $date
     * @return mixed
     */
    private function getNumberTicketFor(\DateTime $date)
    {
        return $this->em->getRepository('ShopBundle:Booking')->getBookingFor($date);
    }
}
?>