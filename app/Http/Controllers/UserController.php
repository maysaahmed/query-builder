<?php

namespace App\Http\Controllers;

use App\Models\User;
use \Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class UserController extends Controller
{

    /**
     * display users filter
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $filter = $request->filter;
        if( $filter == null)
            return view('index');

        $query = $this->buildQuery($filter);

        $all = $query->get();

        //count of males and females
        $males =  $all->where('gender', 'male')->count();
        $females =  $all->where('gender', 'female')->count();

        //count of age segmentation
        $ages['firstSegment'] = $all->whereBetween('age', [0,20])->count(); // 0->20
        $ages['secondSegment'] = $all->whereBetween('age', [20,40])->count(); // 20->40
        $ages['thirdSegment'] = $all->whereBetween('age', [40,80])->count(); // 40->80

        //months creation
        $users = $all->groupBy(function($date) {
            return Carbon::parse($date->creation_date)->format('m'); // grouping by months
        });
        $users_month = $this->getCountPerMonth($users);

        return view('index', compact('filter', 'males', 'females', 'ages', 'users_month'));
    }

    /**
     * build query dynamically
     * @param $filters
     * @return mixed
     */
    private function buildQuery($filters)
    {
        $query = User::select();

        foreach ($filters as $filter) {
            $operator = $this->replaceOperator($filter['operator']); // for >, < operators from javascript

            if(isset($filter['join']) && $filter['join'] == 'or') {
                $where = 'orwhere';
            }else{
                $where = 'where';
            }

            switch ($operator){
                case 'startswith':
                    $query->$where($filter['col'], 'like', $filter['value'].'%');
                    break;
                case 'endswith':
                    $query->$where($filter['col'], 'like', '%'.$filter['value']);
                    break;
                case 'contains':
                    $query->$where($filter['col'], 'like', '%'.$filter['value'].'%');
                    break;
                case 'exact':
                    $query->$where($filter['col'], $filter['value']);
                    break;
                default:
                    $query->$where($filter['col'], $operator, $filter['value']);
            }

        }
        return $query;
    }

    /**
     * for >, < operators from javascript
     * @param $operator
     * @return string
     */
    private function replaceOperator($operator)
    {
        $operators = [
            '&gt;' => '>',
            '&lt;' => '<',
        ];
        return isset($operators[$operator]) ? $operators[$operator]: $operator;
    }

    /**
     * count of created users per each month
     * @param $users
     * @return array
     */
    private function getCountPerMonth($users)
    {
        $userMonthCount = [];
        $userArr = [];
        foreach ($users as $key => $value) {
            $userMonthCount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($userMonthCount[$i])){
                $userArr[] = $userMonthCount[$i];
            }else{
                $userArr[] = 0;
            }
        }
        return $userArr;
    }

    /**
     * users for datatable
     * @param Request $request
     * @return mixed
     */
    public function apiUsers(Request $request)
    {
        $query = $this->buildQuery($request->filter);
        return Datatables::of($query->orderBy('num_msgs', 'desc'))->make(true);
    }


}
