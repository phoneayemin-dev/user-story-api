<?php

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use App\Models\Employee;

class EmployeesPaginationQuery extends Query
{
    protected $attributes = [
        'name' => 'EmployeesPaginationQuery',
        'description' => 'Employees Pagination Query'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('employee');
    }

    public function args(): array
    {
        return [
            'page' => ['type' => Type::nonNull(Type::int())],
            'per_page' => ['type' => Type::nonNull(Type::int())],
            'id' => ['name' => 'id', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        // $employees = Employee::select($select);
        // if(isset($args['id'])) {
        //     $employees = $employees->where('id', $args['id']);
        // }
        $employees = Employee::orderBy('created_at', 'DESC');
        return $employees->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}