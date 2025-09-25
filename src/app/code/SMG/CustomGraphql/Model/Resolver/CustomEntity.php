<?php

declare(strict_types=1);
/**
 * Package: SMG_CustomGraphql
 * Author: Supravat Mondal <supravat.com@gmail.com>
 * license: MIT
 * Copyright: 2025
 * Description: Resolver for customData query
 */

namespace SMG\CustomGraphql\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;

class CustomEntity implements ResolverInterface, IdentityInterface
{
    /**
     * @inheritDoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ): array {
        if (empty($args['id']) || $args['id'] <= 0) {
            throw new GraphQlInputException(__('Invalid "id" value.'));
        }

        try {
            // Normally fetch from repository/service contract
            return [
                'id'     => $args['id'],
                'name'   => 'Example Entity',
                'status' => 'active'
            ];
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__('Entity with ID "%1" not found.', $args['id']));
        }
    }

    /**
     * Return cache identities for the entity
     *
     * @param array|null $resolvedValue
     * @return string[]
     */
    public function getIdentities(?array $resolvedValue = null): array
    {
        return isset($resolvedValue['id'])
            ? ['custom_entity_' . $resolvedValue['id']]
            : [];
    }
}
