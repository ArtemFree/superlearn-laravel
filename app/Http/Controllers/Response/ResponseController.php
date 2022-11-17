<?php

namespace App\Http\Controllers\Response;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Project;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $project = Project::find($id);

        return view('response.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'about_response' => ['required']
        ]);

        $project = Project::find($id);
        $user =  $request->user();

        if ($project->author_id || $project->is_completed || $project->is_archived_manually || $project->is_archived_manually || $project->is_failed) {
            return abort(403, 'Проект уже завершен');
        }

        $author = Author::where('user_id', $user->id)->first();

        Response::create([
            'project_id' => $id,
            'author_id' => $author->id,
            'user_id' => $project->id
        ]);

        return Redirect::to('/project/'.$project->id.'/response/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $responseId = null)
    {

        //разделить меня и второго юзера
        $user = $request->user();
        $my_user_id = $user->author ? $user->author->id : $user->id;
        $user_key = $user->author ? 'author_id' : 'user_id';
        $response = null;

        if ($responseId) {
            // when user - creator project
            $response = Response::find($responseId);
        } else {
            // when author - applied to project
            $response = Response::where('project_id', $id)->where($user_key, $my_user_id)->first();
        }

        abort_if(!$response, 404);

        return view('response.page', array('response' => $response, 'user' => $user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
