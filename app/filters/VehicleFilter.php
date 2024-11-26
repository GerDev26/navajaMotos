<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class VehicleFilter extends ApiFilter {
    protected $queryParams = [
        'id' => ['eq'],
        'domain' => ['eq', 'like'],
        'green_card' => ['eq', 'like'],
        'user_id' => ['eq'],
        'vehicle_model_id' => ['eq'],
        'created_at' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];
    protected $columnMap = [
        'createdAt' => 'created_at'
    ];
    protected $operatorMap = [
        'eq' => '=',
        'di' => '!=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'like' => 'like',
    ];
}