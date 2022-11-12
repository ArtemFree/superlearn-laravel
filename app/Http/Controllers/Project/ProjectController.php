<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{

    private $project_orders = array('new' => 'DESC', 'old' => 'ASC');

    public function index(Request $request, $id)
    {
        $project = Project::find($id);
        if ($project) {
            return view('project.page', array('project' => $project));
        } else {
            return view('project.404');
        }
    }

    public function projects(Request $request)
    {
        $project_type = $request->query('project_type', 'all');
        $award_from = $request->query('award_from');
        $project_order = $request->query('project_order', 'new') ;
        $projects = [];

        if ($project_type) {
            switch ($project_type) {
                case 'completed':
                    $projects = Project::where('is_completed', 1)->orderBy('created_at', $this->project_orders[$project_order])->get();
                    break;

                case 'archived':
                    $projects = Project::where('is_archived_manually', 1)->orderBy('created_at', $this->project_orders[$project_order])->get();
                    break;

                case 'all':
                    $projects = Project::orderBy('created_at', $this->project_orders[$project_order])->get();
                    break;
            }
        } else {
            $projects = Project::orderBy('created_at', $this->project_orders[$project_order])->get();
        }

        if ($award_from) {
            $projects = $projects->where('award', '>=', $award_from)->orderBy('created_at', $this->project_orders[$project_order]);
        }

        return view('project.projects', array('projects' => $projects, 'project_type' => $project_type, 'award_from' => $award_from, 'project_order' => $project_order));
    }
}
