<?php

namespace Modules\Icommerce\Repositories\Eloquent;

use Modules\Icommerce\Repositories\CartProductRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCartProductRepository extends EloquentBaseRepository implements CartProductRepository
{
  
  public function index($params)
  {
    // INITIALIZE QUERY
    $query = $this->model->query();
  
    // RELATIONSHIP
    $defaultInclude = [];
    $query->with(array_merge($defaultInclude,$params->include));
    
    // FILTERS
    if($params->filters) {
      $filter = $params->filter;
      
      //set language translation
      \App::setLocale($filter->locale ?? null);
      
      //add filter by search
      if (isset($filter->search)) {
        //find search in columns
        $query->where('id', 'like', '%' . $filter->search . '%')
          ->orWhere('product_name', 'like', '%' . $filter->search . '%')
          ->orWhere('product_id', 'like', '%' . $filter->search . '%')
          ->orWhere('updated_at', 'like', '%' . $filter->search . '%')
          ->orWhere('created_at', 'like', '%' . $filter->search . '%');
      }
    }
    // FIELDS
    if ($params->fields) {
      $query->select($params->fields);
    }
    
    // PAGE & TAKE
    //Return request with pagination
    if ($params->page) {
      $params->take ? true : $params->take = 12; //If no specific take, query take 12 for default
      return $query->paginate($params->take);
    }
    
    //Return request without pagination
    if (!$params->page) {
      $params->take ? $query->take($params->take) : false; //if request to take a limit
      return $query->get();
    }
  }
  
  public function show($criteria, $params)
  {
    // INITIALIZE QUERY
    $query = $this->model->query();
    
    $query->where('id', $criteria);
    
    // RELATIONSHIPS
    $includeDefault = [];
    $query->with(array_merge($includeDefault, $params->include));
    
    // FIELDS
    if ($params->fields) {
      $query->select($params->fields);
    }
    return $query->first();
    
  }
}