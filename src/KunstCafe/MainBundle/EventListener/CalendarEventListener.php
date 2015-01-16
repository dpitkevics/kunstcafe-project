<?php

namespace KunstCafe\MainBundle\EventListener;


use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;
use KunstCafe\MainBundle\Entity\Event;
use Symfony\Component\DependencyInjection\Container;

class CalendarEventListener
{
    /** @var EntityManager */
    private $entityManager;
    /** @var Container */
    private $container;

    public function __construct(Container $container, EntityManager $entityManager)
    {
        $this->container = $container;
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        // The original request so you can get filters from the calendar
        // Use the filter in your query for example

        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');


        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        $galleryEvents = $this->entityManager->getRepository('KunstCafeMainBundle:Event')->findAll();

        // $companyEvents and $companyEvent in this example
        // represent entities from your database, NOT instances of EventEntity
        // within this bundle.
        //
        // Create EventEntity instances and populate it's properties with data
        // from your own entities/database values.

        /** @var Event $galleryEvent */
        foreach($galleryEvents as $galleryEvent) {

            // create an event with a start/end time, or an all day event
            $eventEntity = new EventEntity($galleryEvent->getTitle(), $galleryEvent->getStartingTime(), $galleryEvent->getEndingTime());

            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($eventEntity);
        }
    }
}