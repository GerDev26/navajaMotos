<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class ReplacementFilter extends ApiFilter {
    protected $queryParams = [
        'id' => ['eq'],
        'description' => ['eq', 'like'],
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