<?php

namespace App\Filters;
use Illuminate\Http\Request;

class ApiFilter {
    protected $queryParams = [];
    protected $columnMap = [];
    protected $operatorMap = [];
    private $ordersParam = [
        'orderAsc' => 'asc',
        'orderDesc' => 'desc'
    ];

    public function transform(Request $request): array{
        $eloQuery = [];
        foreach ($this->queryParams as $param => $queryOperator) {
            $query = $request->query($param);
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$param] ?? $param;
            foreach ($queryOperator as $operator) {
                if(isset($query[$operator])){
                    $value = $this->operatorMap[$operator] == 'like' ? "%$query[$operator]%" : $query[$operator];
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $value];
                }
            }
        }
        return $eloQuery;
    }
    public function order(Request $request) {
        foreach ($this->queryParams as $queryParam => $queryOperator) {
            foreach ($this->ordersParam as $orderParam => $orderValue) {
                $query = $request->query($orderParam);
                if(!isset($query)) {
                    continue;
                }
                $column = $this->columnMap[$query] ?? $query;
                if($column == $queryParam){
                    return [$column, $orderValue];
                }
            }   
        }
        return ["id", "asc"];
    }
}