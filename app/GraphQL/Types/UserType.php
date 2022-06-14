<?php
namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType{

    protected $attributes = [
        'name'          => 'User',
        'description'   => 'An User',
        'model'         => User::class,
    ];
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'The id of the employee',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of employee',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the employee',
            ],
            
        ];
    }

}