<?php
namespace App\GraphQL\Types;

use App\Models\Employee;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class EmployeeType extends GraphQLType{

    protected $attributes = [
        'name'          => 'Employee',
        'description'   => 'An Employee',
        'model'         => Employee::class,
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
            'code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The code of the employee',
            ],
            'phone_no' => [
                'type' => Type::string(),
                'description' => 'The phone number of the employee',
            ],
            
            'status' => [
                'type' => Type::string(),
                'description' => 'The status of the employee',
            ],

        ];
    }

}