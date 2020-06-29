<?php

namespace App\Tests\Services;

use App\DTO\AllowEntranceDTO;
use App\DTO\IdentifiedCaseDTO;
use App\Services\IdentifiedCaseHandler;
use App\Transformer\IdentifiedCaseTransformer;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class IdentifiedCaseHandlerTest extends KernelTestCase
{
    private $em;

    public function setUp()
    {
        self::bootKernel();

        parent::setUp();

        $this->em = static::$container->get('doctrine')->getManager();
        $this->em->getConnection()->beginTransaction();
    }

    protected function tearDown(): void
    {
        if ($this->em->getConnection()->isTransactionActive()) {
            try {
                $this->em->getConnection()->rollBack();
            } catch (\Exception $e) {
            }
        }

        parent::tearDown();

        $this->em = null;
    }

    private function getHandler(): IdentifiedCaseHandler
    {
        $repositoryMock = $this->createMock(ObjectRepository::class);
        $emMock = $this->createMock(EntityManagerInterface::class);
        $emMock
            ->method('getRepository')
            ->willReturn($repositoryMock);

        return new IdentifiedCaseHandler($emMock,
            static::$container->get('validator'),
            static::$container->get(IdentifiedCaseTransformer::class));
    }

    /**
     * @return IdentifiedCaseDTO
     */
    private function getIdentifiedCaseDTO(): IdentifiedCaseDTO
    {
        $dto = new IdentifiedCaseDTO();
        $dto->photoFilename = '/homme/';
        $dto->temperature = 39;
        $dto->datePhoto = new DateTime();
        $dto->firstDate = new DateTime();

        return $dto;
    }

    /**
     * @return AllowEntranceDTO
     */
    private function getAllowEntranceDTO(): AllowEntranceDTO
    {
        $dto = new AllowEntranceDTO();
        $dto->allowEntrance = new DateTime();

        return $dto;
    }

    public function testValidateEmptyPhotoFilename(): void
    {
        $handler = $this->getHandler();
        $dto = $this->getIdentifiedCaseDTO();
        $dto->photoFilename = '';
        $result = $handler->updateIdentifiedCase($dto);

        $this->assertCount(2, $result);
        $this->assertEquals('photoFilename', $result->get(0)->getPropertyPath());
        $this->assertEquals('This value should not be blank.', $result->get(0)->getMessage());
    }
}
