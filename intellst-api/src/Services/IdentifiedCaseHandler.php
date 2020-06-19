<?php

namespace App\Services;

use App\DTO\IdentifiedCaseDTO;
use App\Entity\IdentifiedCase;
use App\Transformer\IdentifiedCaseTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IdentifiedCaseHandler
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var ValidatorInterface */
    private $validator;

    /** @var IdentifiedCaseTransformer */
    private $identifiedCaseTransformer;

    public function __construct(
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        IdentifiedCaseTransformer $identifiedCaseTransformer
    ) {
        $this->em = $em;
        $this->validator = $validator;
        $this->identifiedCaseTransformer = $identifiedCaseTransformer;
        $this->identifiedCaseRepository = $this->em->getRepository(IdentifiedCase::class);
    }

    public function updateIdentifiedCase(IdentifiedCaseDTO $dto): ConstraintViolationListInterface
    {
        $identifiedCase = $this->identifiedCaseTransformer->transformDTOToEntity($dto);

        $errors = $this->validator->validate($identifiedCase);
        $dtoErrors = $this->validator->validate($dto, null);

        foreach ($dtoErrors as $error) {
            $errors->add($error);
        }

        if ($errors->count() === 0) {
            $this->em->persist($identifiedCase);
            $this->em->flush();
        }

        return $errors;
    }

    public function getList(): array
    {
        $users = $this->identifiedCaseRepository->findAll();
        $arr = [];
        foreach ($users as $user) {
            $userDTO = $this->identifiedCaseTransformer->transformEntityToDTO($user);
            $arr[] = $userDTO;
        }

        return $arr;
    }
}
