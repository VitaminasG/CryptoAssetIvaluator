<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Asset\Hydrator\AssetOutputTransformer;
use App\DTO\Asset\Input\AssetCollectionDto;
use App\DTO\Asset\Output\AssetTotalDto;
use App\DTO\Asset\Resolver\Input\AssetCollectionValueResolver;
use App\DTO\Error\ValidationError;
use App\Repository\UserRepository;
use App\Service\AssetCreateService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class AssetController extends AbstractController
{
    private AssetOutputTransformer $assetOutputTransformer;
    private UserRepository $userRepository;
    private AssetCreateService $assetCreateService;

    public function __construct(
        AssetOutputTransformer $assetOutputTransformer,
        UserRepository $userRepository,
        AssetCreateService $assetCreateService
    ) {
        $this->assetOutputTransformer = $assetOutputTransformer;
        $this->userRepository = $userRepository;
        $this->assetCreateService = $assetCreateService;
    }

    #[Route('/user/{id}/asset', methods: [Request::METHOD_GET])]
    #[OA\Get(path: '/api/user/{id}/asset', description: 'Get User asset by Id')]
    #[OA\Tag('Assets')]
    #[OA\Parameter(
        name: 'id',
        description: 'ID of the user to fetch assets for',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Response(
        response: Response::HTTP_OK,
        description: 'Successful response',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: AssetTotalDto::class))
        )
    )]
    #[OA\Response(
        response: Response::HTTP_NOT_FOUND,
        description: 'User not found',
        content: new OA\JsonContent(ref: new Model(type: ValidationError::class))
    )]
    public function index(int $id): Response
    {
        if ($user = $this->userRepository->find($id)) {
            $assetOutput = $this->assetOutputTransformer->transform($user->getAssets());

            return $this->json($assetOutput, Response::HTTP_OK);
        }

        return $this->json(
            new ValidationError(
                Response::HTTP_NOT_FOUND,
                'User not found'
            )
        );
    }

    #[Route('/user/{id}/asset', methods: [Request::METHOD_POST])]
    #[OA\Post(
        path: '/user/{id}/asset',
        description: 'Asset data that needs to be added to the user'
    )]
    #[OA\Tag('Assets')]
    #[OA\Parameter(
        name: 'id',
        description: 'ID of the user to fetch assets for',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Response(
        new OA\Response(
            response: Response::HTTP_OK,
            description: 'Asset successfully added',
            content: new OA\JsonContent(type: 'string')
        )
    )]
    #[OA\Response(
        response: Response::HTTP_BAD_REQUEST,
        description: 'Invalid input',
        content: new OA\JsonContent(ref: new Model(type: ValidationError::class))
    )]
    #[OA\Response(
        response: Response::HTTP_NOT_FOUND,
        description: 'User not found',
        content: new OA\JsonContent(ref: new Model(type: ValidationError::class))
    )]
    public function create(
        #[MapRequestPayload(
            resolver: AssetCollectionValueResolver::class
        )]
        AssetCollectionDto $assetCollectionDto,
        int $id
    ): Response {
        if (!$user = $this->userRepository->find($id)) {

            return $this->json(
                new ValidationError(
                    Response::HTTP_NOT_FOUND,
                    'User not found'
                )
            );
        }

        $this->assetCreateService->create($assetCollectionDto, $user);

        return $this->json('OK', Response::HTTP_OK);
    }
}
