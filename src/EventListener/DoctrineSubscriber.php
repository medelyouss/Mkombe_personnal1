<?php

namespace App\EventListener;

use App\Entity\Log;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

class DoctrineSubscriber implements EventSubscriber
{

    private $logger;
    private $em;

    public function __construct(LoggerInterface $dbLogger, EntityManagerInterface $entityManager)
    {
        $this->logger = $dbLogger;
        $this->em = $entityManager;
        date_default_timezone_set("Africa/Dar_es_Salaam");
    }

    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logActivity('Ajout', $args);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $this->logActivity('Suppression', $args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->logActivity( 'Modification', $args);
    }


    private function logActivity(string $action, LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $className = $this->em->getClassMetadata(get_class($entity))->getName();

        $dataChanged = $this->em->getUnitOfWork();
        $dataChanged->computeChangeSets();

        $changeset = json_encode($dataChanged->getEntityChangeSet($entity));
        //dd($changeset);

        // if this subscriber only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Log
            //and !$entity instanceof CotisationFopLoadData
            //and !$entity instanceof CotisationFopLoadFile
            //and !$entity instanceof CotisationLoadFile
            //and !$entity instanceof CotisationLoadData
        ) {
            if (method_exists($entity , '__toString')){
                $this->logger->info($action . ' de l\'ID "' . $entity->getId(). '-' .$entity. '" => ' .$className.' => Détails'. $changeset);
            }else{
                $this->logger->info($action . ' de l\'ID : "' . $entity->getId(). '" => ' .$className.' => Détails'. $changeset);
            }
        }
    }


}