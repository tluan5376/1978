<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Manager\CategoryRepository;
use App\Models\Product\Category; 
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class CategoryController extends Controller
{
    protected $category;
    protected $category_type;

    public function __construct(Category $category){
        $this->category             = new CategoryRepository($category); 
    }
    public function get(){
        $data_category  = $this->category->get_data(); 
        return $this->category->send_response("Get category", $data_category, 200);
    }
    public function get_type($id){
        $data  = $this->category->get_type($id);
        return $this->category->send_response(200, $data, null);
    }

}
