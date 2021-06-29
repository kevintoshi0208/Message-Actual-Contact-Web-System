<?php
namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class LegalVisitText extends Constraint
{
    public string $message = "The text is not valid.";
    public string $messageBusiness = "The business is not valid.";

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}