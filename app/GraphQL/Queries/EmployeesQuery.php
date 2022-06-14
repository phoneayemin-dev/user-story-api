<?php
namespace App\GraphQL\Queries;

use Closure;
use App\Models\Employee;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class EmployeesQuery extends Query
{
    protected $attributes = [
        'name' => 'employees',
        'description' => "Employees",
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('employee'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id', 
                'type' => Type::string(),
            ],
            'code' => [
                'name' => 'code', 
                'type' => Type::string(),
            ],
            'phone_no' => [
                'name' => 'code', 
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return Employee::where('id' , $args['id'])->get();
        }

        if (isset($args['code'])) {
            return Employee::where('code', $args['code'])->get();
        }

        return Employee::all();
    }
}