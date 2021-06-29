<?php
namespace App\Validator;

use App\Entity\Business;
use App\Service\DealVisitTextService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class LegalVisitTextValidator extends ConstraintValidator
{
    private DealVisitTextService $dealVisitText;
    private EntityManagerInterface $em;

    public function __construct(
        DealVisitTextService $dealVisitText,
        EntityManagerInterface $em
    ) {
        $this->dealVisitText = $dealVisitText;
        $this->em = $em;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $code = $this->dealVisitText->dealVisitText($value);

        if (!$code ){
            $this->context->buildViolation($constraint->message)
                ->atPath('text')
                ->addViolation()
            ;
        } else {
            $businessRepo = $this->em->getRepository(Business::class);
            if (!$businessRepo->find($code)){
                $this->context->buildViolation($constraint->messageBusiness)
                    ->atPath('text')
                    ->addViolation()
                ;
            }
        }


    }
}