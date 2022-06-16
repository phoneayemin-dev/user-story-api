<?php
namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class RegisterUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RegisterUserMutation',
        'description' => 'Register User Mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name', 
                'type' => Type::string(),
            ],
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
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password'])
        ]);   
        return $user;
    }
}