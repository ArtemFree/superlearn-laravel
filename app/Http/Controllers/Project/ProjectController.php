<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    private $project_orders = array('new' => 'DESC', 'old' => 'ASC');

    public function index(Request $request, $id)
    {
        $project = Project::find($id);

        abort_if(!$project, 404);

        if ($request->user()->cannot('view', $project)) {
            abort(403);
        }

        if ($project) {
            return view('project.page', array('project' => $project));
        } else {
            return view('project.404');
        }
    }

    public function create_page(Request $request)
    {
        return view('project.create', array('user' => $request->user(), 'action' => 'create'));
    }

    public function edit_page(Request $request, $id)
    {
        $project = Project::find($id);

        if ($request->user()->cannot('update', $project)) {
            abort(403);
        }

        if ($project) {
            return view('project.edit', array('project' => $project, 'user' => $request->user(), 'action' => 'edit'));
        }
    }

    public function create(Request $request)
    {
        if ($request->user()->cannot('create', $request->user())) {
            // abort(403);
        }
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string'],
            'award' => ['required', 'integer']
        ]);

        $project = Project::create([
            'name' => $request->name,
            'about' => $request->about,
            'award' => $request->award,
            'short_about' => $request->short_about ?? '',
            // 'user_id' => $request->user()->id
        ]);

        return Redirect::to('/project/' . $project->id);
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string'],
            'award' => ['required', 'integer']
        ]);

        $project = Project::find($id);

        if ($request->user()->cannot('update', $project)) {
            abort(403);
        }

        $project->update(
            [
                'name' => $request->name,
                'about' => $request->about,
                'award' => $request->award,
                'short_about' => $request->short_about ?? ''
            ]
        );

        return Redirect::to('/project/' . $project->id);
    }

    public function delete(Request $request, $id)
    {
        $project = Project::find($id);

        if ($request->user()->cannot('delete', $project)) {
            abort(403);
        }

        $project->delete();

        return Redirect::to('/projects');
    }

    public function projects(Request $request)
    {
        $project_type = $request->query('project_type', 'all');
        $award_from = $request->query('award_from');
        $project_order = $request->query('project_order', 'new');
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
