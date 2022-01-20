<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use app\Models\User;
use App\Models\UserActive;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projectsDiv = Project::where('status_id', 1)->paginate(10);
        $projectsDept1 = Project::where('status_id', '1')->where('deptID', '3')->paginate(10);
        $projectsDept2 = Project::where('status_id', '1')->where('deptID', '4')->paginate(10);
        $projectsDept3 = Project::where('status_id', '1')->where('deptID', '5')->paginate(10);
        $projectsDept4 = Project::where('status_id', '1')->where('deptID', '6')->paginate(10);



        $onProjectsDept1 = Project::join('project_user', 'projects.id', '=', 'project_user.project_id')
            ->where('projects.status_id', '1')
            ->where('projects.deptID', '3')
            ->where('project_user.user_id', auth()->user()->id)->paginate(10);
        $onProjectsDept2 = Project::join('project_user', 'projects.id', '=', 'project_user.project_id')
            ->where('projects.status_id', '1')
            ->where('projects.deptID', '4')
            ->where('project_user.user_id', auth()->user()->id)->paginate(10);
        $onProjectsDept3 = Project::join('project_user', 'projects.id', '=', 'project_user.project_id')
            ->where('projects.status_id', '1')
            ->where('projects.deptID', '5')
            ->where('project_user.user_id', auth()->user()->id)->paginate(10);
        $onProjectsDept4 = Project::join('project_user', 'projects.id', '=', 'project_user.project_id')
            ->where('projects.status_id', '1')
            ->where('projects.deptID', '6')
            ->where('project_user.user_id', auth()->user()->id)->paginate(10);

        $id = ($projectsDiv->currentpage() - 1) * $projectsDiv->perpage() + 1;
        $id1 = ($projectsDept1->currentpage() - 1) * $projectsDept1->perpage() + 1;
        $id2 = ($projectsDept2->currentpage() - 1) * $projectsDept2->perpage() + 1;
        $id3 = ($projectsDept3->currentpage() - 1) * $projectsDept3->perpage() + 1;
        $id4 = ($projectsDept4->currentpage() - 1) * $projectsDept4->perpage() + 1;
        $id5 = ($onProjectsDept1->currentpage() - 1) * $onProjectsDept1->perpage() + 1;
        $id6 = ($onProjectsDept2->currentpage() - 1) * $onProjectsDept2->perpage() + 1;
        $id7 = ($onProjectsDept3->currentpage() - 1) * $onProjectsDept3->perpage() + 1;
        $id8 = ($onProjectsDept4->currentpage() - 1) * $onProjectsDept4->perpage() + 1;

        // Chart
        // Day   branch, cr, micro, internal
        // [1,  37.8, 80.8, 41.8, 99],

        $day7 = [];
        $day6 = [];
        $day5 = [];
        $day4 = [];
        $day3 = [];
        $day2 = [];
        $day1 = [];

        $dept1 = 0;
        $dept2 = 0;
        $dept3 = 0;
        $dept4 = 0;

        // =======================
        $index_day = 6;
        $current_date = Carbon::today()->subDay($index_day)->format('Y-m-d');

        $day = UserActive::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();

        foreach ($day as $day) {
            if ($day->roleID == 3 || $day->roleID == 7) {
                $dept1 = $dept1 + 1;
            } else if ($day->roleID == 4 || $day->roleID == 8) {
                $dept2 = $dept2 + 1;
            } else if ($day->roleID == 5 || $day->roleID == 9) {
                $dept3 = $dept3 + 1;
            } else if ($day->roleID == 6 || $day->roleID == 10) {
                $dept4 = $dept4 + 1;
            }
        }
        $current_date = (int)Carbon::now()->subDay($index_day)->format('d');
        $day7 = [$current_date, $dept1, $dept2, $dept3, $dept4];

        // ====================================
        $index_day = $index_day - 1;
        $current_date = Carbon::today()->subDay($index_day)->format('Y-m-d');

        $day = UserActive::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();

        foreach ($day as $day) {
            if ($day->roleID == 1) {
                $dept1 = $dept1 + 1;
            } else if ($day->roleID == 2) {
                $dept2 = $dept2 + 1;
            } else if ($day->roleID == 3) {
                $dept3 = $dept3 + 1;
            } else if ($day->roleID == 4) {
                $dept4 = $dept4 + 1;
            }
        }
        $current_date = (int)Carbon::now()->subDay($index_day)->format('d');
        $day6 = [$current_date, $dept1, $dept2, $dept3, $dept4];

        // ====================================
        $index_day = $index_day - 1;
        $current_date = Carbon::today()->subDay($index_day)->format('Y-m-d');

        $day = UserActive::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();

        foreach ($day as $day) {
            if ($day->roleID == 3 || $day->roleID == 7) {
                $dept1 = $dept1 + 1;
            } else if ($day->roleID == 4 || $day->roleID == 8) {
                $dept2 = $dept2 + 1;
            } else if ($day->roleID == 5 || $day->roleID == 9) {
                $dept3 = $dept3 + 1;
            } else if ($day->roleID == 6 || $day->roleID == 10) {
                $dept4 = $dept4 + 1;
            }
        }
        $current_date = (int)Carbon::now()->subDay($index_day)->format('d');
        $day5 = [$current_date, $dept1, $dept2, $dept3, $dept4];

        // ====================================
        $index_day = $index_day - 1;
        $current_date = Carbon::today()->subDay($index_day)->format('Y-m-d');

        $day = UserActive::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();

        foreach ($day as $day) {
            if ($day->roleID == 3 || $day->roleID == 7) {
                $dept1 = $dept1 + 1;
            } else if ($day->roleID == 4 || $day->roleID == 8) {
                $dept2 = $dept2 + 1;
            } else if ($day->roleID == 5 || $day->roleID == 9) {
                $dept3 = $dept3 + 1;
            } else if ($day->roleID == 6 || $day->roleID == 10) {
                $dept4 = $dept4 + 1;
            }
        }
        $current_date = (int)Carbon::now()->subDay($index_day)->format('d');
        $day4 = [$current_date, $dept1, $dept2, $dept3, $dept4];

        // ====================================
        $index_day = $index_day - 1;
        $current_date = Carbon::today()->subDay($index_day)->format('Y-m-d');

        $day = UserActive::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();

        foreach ($day as $day) {
            if ($day->roleID == 3 || $day->roleID == 7) {
                $dept1 = $dept1 + 1;
            } else if ($day->roleID == 4 || $day->roleID == 8) {
                $dept2 = $dept2 + 1;
            } else if ($day->roleID == 5 || $day->roleID == 9) {
                $dept3 = $dept3 + 1;
            } else if ($day->roleID == 6 || $day->roleID == 10) {
                $dept4 = $dept4 + 1;
            }
        }
        $current_date = (int)Carbon::now()->subDay($index_day)->format('d');
        $day3 = [$current_date, $dept1, $dept2, $dept3, $dept4];

        // ====================================
        $index_day = $index_day - 1;
        $current_date = Carbon::today()->subDay($index_day)->format('Y-m-d');

        $day = UserActive::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();

        foreach ($day as $day) {
            if ($day->roleID == 3 || $day->roleID == 7) {
                $dept1 = $dept1 + 1;
            } else if ($day->roleID == 4 || $day->roleID == 8) {
                $dept2 = $dept2 + 1;
            } else if ($day->roleID == 5 || $day->roleID == 9) {
                $dept3 = $dept3 + 1;
            } else if ($day->roleID == 6 || $day->roleID == 10) {
                $dept4 = $dept4 + 1;
            }
        }
        $current_date = (int)Carbon::now()->subDay($index_day)->format('d');
        $day2 = [$current_date, $dept1, $dept2, $dept3, $dept4];

        // ====================================
        $index_day = $index_day - 1;
        $current_date = Carbon::today()->subDay($index_day)->format('Y-m-d');

        $day = UserActive::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();

        foreach ($day as $day) {
            if ($day->roleID == 3 || $day->roleID == 7) {
                $dept1 = $dept1 + 1;
            } else if ($day->roleID == 4 || $day->roleID == 8) {
                $dept2 = $dept2 + 1;
            } else if ($day->roleID == 5 || $day->roleID == 9) {
                $dept3 = $dept3 + 1;
            } else if ($day->roleID == 6 || $day->roleID == 10) {
                $dept4 = $dept4 + 1;
            }
        }
        $current_date = (int)Carbon::now()->subDay($index_day)->format('d');
        $day1 = [$current_date, $dept1, $dept2, $dept3, $dept4];
        // dd(json_encode($day7));

        $monthName = Carbon::now()->format('F');


        // var_dump($monthName);

        return view('home', compact(
            'day7',
            'day6',
            'day5',
            'day4',
            'day3',
            'day2',
            'day1',
            'monthName',
            'projectsDiv',
            'projectsDept1',
            'projectsDept2',
            'projectsDept3',
            'projectsDept4',
            'onProjectsDept1',
            'onProjectsDept2',
            'onProjectsDept3',
            'onProjectsDept4', 
            'id', 'id1', 'id2', 'id3', 'id4', 'id5', 'id6', 'id7', 'id8',
        ));
    }
}
