<?php

namespace App\Controller;

use App\DTO\EnterpriseDTO;
use App\Entity\Enterprise;
use App\Services\EnterpriseHandler;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Serializer\ValidationErrorSerializer;

class EnterpriseController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var EnterpriseHandler
     */
    private $enterpriseHandler;

    /**
     * @var ValidationErrorSerializer
     */
    private $validationErrorSerializer;

    public function __construct(
        EnterpriseHandler $enterpriseHandler,
        SerializerInterface $serializer,
        ValidationErrorSerializer $validationErrorSerializer
    ) {
        $this->serializer = $serializer;
        $this->enterpriseHandler = $enterpriseHandler;
        $this->validationErrorSerializer = $validationErrorSerializer;
    }

    /**
     * @Route("/api/enterprise-register", name="enterprise_register", methods={"POST"})
     * @Route("/api/enterprises", name="enterprises_add", methods={"POST"})
     */
    public function addEnterprise(Request $request): JsonResponse
    {
        $data = $request->getContent();

        /** @var DeserializationContext $context */
        $context = DeserializationContext::create()->setGroups(array('UserAdd'));

        $addEnterpriseDTO = $this->serializer->deserialize(
            $data,
            EnterpriseDTO::class,
            'json',
            $context
        );

        $errors = $this->enterpriseHandler->updateEnterprise($addEnterpriseDTO);
        if ($errors->count()) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Bad Request',
                    'errors' => $this->validationErrorSerializer->serialize($errors),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(['message' => 'Enterprise added successfully'], Response::HTTP_OK);
    }

    /**
     * @Route("/api/enterprises/{enterprise}", name="enterprise_edit", methods={"POST"})
     */
    public function editEnterprise(Request $request, Enterprise $enterprise): JsonResponse
    {
        $data = $request->getContent();

        /** @var DeserializationContext $context */
        $context = DeserializationContext::create()->setGroups(array('UserEdit'));

        $editEnterpriseDTO = $this->serializer->deserialize(
            $data,
            EnterpriseDTO::class,
            'json',
            $context
        );

        $errors = $this->enterpriseHandler->updateEnterprise($editEnterpriseDTO, $enterprise);
        if ($errors->count()) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Bad Request',
                    'errors' => $this->validationErrorSerializer->serialize($errors),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(['message' => 'Enterprise successfully edited!'], Response::HTTP_OK);
    }

}
