<?php
namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LogoutUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LogoutUserMutation',
        'description' => 'Logout User Mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        auth()->logout();
    }
}