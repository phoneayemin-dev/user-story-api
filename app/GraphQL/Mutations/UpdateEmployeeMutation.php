<?php

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

use App\Models\Employee;

class UpdateEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateEmployee'
    ];

    public function type(): Type
    {
        return GraphQL::type('employee');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'code' => ['name' => 'code', 'type' => Type::string()],
            'phone_no' => ['name' => 'phone_no', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::string()]
        ];
    }


    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   

        $employee = Employee::find($args['id']);
        if (!$employee) {
            return null;
        }
        

        if(isset($args['name'])) {
            $employee->name = $args['name'];
        }

        if(isset($args['code'])) {
            if(Employee::where('code', $args['code'])->where('id', '<>', $args['id'])->exists()) {
                throw new \Exception('Code already exist');
            }
            $employee->code = $args['code'];
        }

        if(isset($args['phone_no'])) {
            $employee->phone_no = $args['phone_no'];
        }
        \Log::info($args['status']);

        if(isset($args['status'])) {
            $employee->status = $args['status'];
        }
        
        $employee->save();

        return $employee;
    }
}