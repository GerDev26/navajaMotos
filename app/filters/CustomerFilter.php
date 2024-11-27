<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class CustomerFilter extends ApiFilter {
    protected $queryParams = [
        'id' => ['eq'],
        'username' => ['eq', 'like'],
        'email' => ['eq', 'like'],
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