<?php
namespace App\GraphQL\Queries;

use Closure;
use App\Models\User;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
        'description' => "Users",
    ];



    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id', 
                'type' => Type::string(),
            ],
            'name' => [
                'name' => 'name', 
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email', 
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return User::where('id' , $args['id'])->get();
        }

        if (isset($args['name'])) {
            return User::where('code', 'like', "%{$args['name']}%")->get();
        }

        if (isset($args['email'])) {
            return User::where('email', 'like', "%{$args['email']}%")->get();
        }
        return User::all();
    }
}