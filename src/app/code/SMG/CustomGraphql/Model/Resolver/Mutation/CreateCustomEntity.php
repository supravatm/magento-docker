<?php

declare(strict_types=1);
/**
 * Package: SMG_CustomGraphql
 * Author: Supravat Mondal <supravat.com@gmail.com>
 * license: MIT
 * Copyright: 2025
 * Description: Resolver for createCustomEntity mutation
 */

namespace SMG\CustomGraphQl\Model\Resolver\Mutation;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class CreateCustomEntity implements ResolverInterface
{
    /**
     * Resolve createCustomEntity GraphQL mutation
     *
     * @param Field $field Field configuration
     * @param mixed $context GraphQL execution context (auth/store info)
     * @param ResolveInfo $info GraphQL schema resolve info
     * @param array|null $value Parent value (for nested resolvers)
     * @param array|null $args Mutation arguments
     * @return array
     * @throws GraphQlInputException
     * @throws GraphQlAuthorizationException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        // Require customer authentication
        // if (!$context->getUserId()) {
        //     throw new GraphQlAuthorizationException(__('Customer authorization is required.'));
        // }

        $input = $args['input'] ?? [];
        if (empty($input['name'])) {
            throw new GraphQlInputException(__('The "name" field is required.'));
        }

        try {
            // Normally save via repository/service contract
            $newEntity = [
                'id'     => rand(1000, 9999), // simulate DB ID
                'name'   => $input['name'],
                'status' => $input['status'] ?? 'active'
            ];

            return [
                'entity'  => $newEntity,
                'success' => true
            ];
        } catch (LocalizedException $e) {
            throw new GraphQlInputException(__($e->getMessage()));
        }
    }
}
