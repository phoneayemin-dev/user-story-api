<?php
namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LoginUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LoginUserMutation',
        'description' => 'Login User Mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            
            'email' => [
                'name' => 'email', 
                'type' => Type::string(),
            ],
            'password' => [
                'name' => 'password', 
                'type' => Type::string(),
            ]

        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (!auth()->attempt(['email' => $args['email'], 'password' => $args['password']])) {
            return "Invalid";
        }
        // return auth()->attempt(['email' => $args['email'], 'password' => $args['password']]);
        return auth()->user();
    }
}