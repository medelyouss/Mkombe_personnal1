<?php
namespace App\GlobalCall;

use App\Entity\Log;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Handler\AbstractProcessingHandler;

class DbHandler extends AbstractProcessingHandler
{

    private $em;

    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct();
        $this->em = $manager;
    }

    /**
     * Called when writing to our database
     * @param array $record
     */
    protected function write(array $record): void
    {
        //logique de mise en log
        $log = new Log();
        $log->setMessage($record['message']);
        $log->setLevel($record['level']);
        $log->setLevelName($record['level_name']);
        $log->setExtra($record['extra']);
        $log->setContext($record['context']);
        $log->setUser($record['extra']['user']);

        $this->em->persist($log);
        $this->em->flush();

    }
}