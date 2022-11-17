<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    private $project_orders = array('new' => 'DESC', 'old' => 'ASC');

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create')) {
            abort(403);
        }

        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create')) {
            abort(403);
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
            'user_id' => $request->user()->id
        ]);

        return Redirect::to('/project/' . $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $project = Project::find($id);

        $user = $request->user();
        if ($user->author) {
            $user = $user->author;
        }

        $response = Response::where('project_id', $project->id)->where('author_id', $user->id)->first();

        abort_if(!$project, 404);

        if ($request->user()->cannot('view', $project)) {
            abort(403);
        }

        if ($project) {
            return view('project.page', array('project' => $project, 'response' => $response));
        } else {
            return view('project.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $project = Project::find($id);

        abort_if(!$project, 404);

        if ($request->user()->cannot('update', $project)) {
            abort(403);
        }

        return view('project.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        abort_if(!$project, 404);

        if ($request->user()->cannot('update', $project)) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string'],
            'award' => ['required', 'integer']
        ]);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $project = Project::find($id);

        abort_if(!$project, 404);

        if ($request->user()->cannot('delete', $project)) {
            abort(403);
        }

        $project->delete();

        return Redirect::to('/profile');
    }
}
