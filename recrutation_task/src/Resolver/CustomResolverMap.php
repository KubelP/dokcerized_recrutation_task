<?php

namespace App\Resolver;

use App\Service\MutationService;
use App\Service\QueryService;
use ArrayObject;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use Overblog\GraphQLBundle\Resolver\ResolverMap;


class CustomResolverMap extends ResolverMap
{
    public function __construct(
        private QueryService    $queryService,
        private MutationService $mutationService
    ) {}

    /**
     * @inheritDoc
     */
    protected function map(): array
    {
        return [
            'RootQuery'    => [
                self::RESOLVE_FIELD => function (
                    $value,
                    ArgumentInterface $args,
                    ArrayObject $context,
                    ResolveInfo $info
                ) {
                    return match ($info->fieldName) {
                        'carbrand' => $this->queryService->findCarBrand($args['id']),
                        'carbrands' => $this->queryService->getAllCarBrands(),
                        default => null
                    };
                },
            ],
            'RootMutation' => [
                self::RESOLVE_FIELD => function (
                    $value,
                    ArgumentInterface $args,
                    ArrayObject $context,
                    ResolveInfo $info
                ) {
                    return match ($info->fieldName) {
                        'createCarBrand' => $this->mutationService->createCarBrand($args['carbrand']),
                        'updateCarBrand' => $this->mutationService->updateCarBrand($args['id'], $args['carbrand']),
                        'deleteCarBrand' => $this->mutationService->deleteCarBrand($args['id']),
                        default => null
                    };
                },

            ],
        ];
    }
}
