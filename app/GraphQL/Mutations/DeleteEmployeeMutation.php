<?php

namespace App\GraphQL\Mutations;

use Auth;
use Config;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

use App\Models\Employee;

class DeleteEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteEmployeeMutation',
        'description' => 'Delete Employee Mutation'
    ];

    public function type(): Type
    {
        // return GraphQL::type('employee');
        return Type::string();
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()]
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'id' => ['required']
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   

        $employee = Employee::find($args['id']);
        if (!$employee) {
            throw new \Exception('Employee not found');
        }
        $employee->delete();

        return $employee;
    }
}