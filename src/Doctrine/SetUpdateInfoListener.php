<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2017/9/13
 * Time: 上午 11:42
 */

namespace App\Doctrine;


use App\Entity\Account;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SetUpdateInfoListener implements EventSubscriber
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function getSubscribedEvents()
    {
        return [Events::prePersist, Events::preUpdate];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getEntity();
        if (method_exists($object, "setCreatedTime")) {
            $object->setCreatedTime(new \DateTime());
        }

        if (method_exists($object, "setUpdatedTime")) {
            $object->setUpdatedTime(new \DateTime());
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $object = $args->getEntity();
        if (method_exists($object, "setUpdatedTime")) {
            $object->setUpdatedTime(new \DateTime());
        }
    }
}