<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Asset\Hydrator\AssetOutputTransformer;
use App\DTO\Asset\Output\AssetDTO;
use App\DTO\Error\ValidationError;
use App\Repository\UserRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class AssetController extends AbstractController
{
    private AssetOutputTransformer $assetOutputTransformer;

    public function __construct(AssetOutputTransformer $assetOutputTransformer)
    {
        $this->assetOutputTransformer = $assetOutputTransformer;
    }

    #[Route('/user/{id}/asset', methods: ['GET'])]
    #[OA\Get(path: '/api/user/{id}/asset', description: 'Get User asset by ID')]
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
            items: new OA\Items(ref: new Model(type: AssetDTO::class))
        )
    )]
    #[OA\Response(
        response: Response::HTTP_NOT_FOUND,
        description: 'User not found',
        content: new OA\JsonContent(ref: new Model(type: ValidationError::class))
    )]
    public function index(int $id, UserRepository $userRepository): Response
    {
        if ($user = $userRepository->find($id)) {
            $assetOutput = $this->assetOutputTransformer->transform($user->getAssets());

            return $this->json($assetOutput, Response::HTTP_OK);
        }

        return $this->json(new ValidationError(Response::HTTP_NOT_FOUND, 'User not found'));
    }
}