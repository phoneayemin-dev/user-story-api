<?php
namespace App\GraphQL\Mutations;

use Closure;
use App\Models\Employee;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateEmployeeMutation',
        'description' => 'Create Employee Mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('employee');
    }

    public function args(): array
    {
        return [
            
            'name' => [
                'name' => 'name', 
                'type' => Type::string(),
            ],
            'code' => [
                'name' => 'code', 
                'type' => Type::string(),
            ],
            'phone_no' => [
                'name' => 'phone_no', 
                'type' => Type::string(),
            ],
            'status' => [
                'name' => 'status', 
                'type' => Type::string(),
            ],
            
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'name.required' => 'Please enter your full name',
            'code.string' => 'Your code must be a valid string',
            'code.exists' => 'Sorry, this code is already in use',
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $employee = Employee::create([
            'name' => $args['name'],
            'code' => $args['code'],
            'phone_no' => $args['phone_no'],
            'status' => $args['status']
        ]);
        
        return $employee;
    }
}