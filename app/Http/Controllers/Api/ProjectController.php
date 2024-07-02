<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('technologies','type')->paginate(10);
        
        $data = [
            'success' => true,
            'results' => $projects
        ];

        return response()->json($data);
    }

    public function show(string $slug){
        $project = Project::with(['type','technologies'])->where('slug',$slug)->first();

        if(!$project){
            return response()->json([
                'success' => false
            ],404);
        }

        $data = [
            'results' => $project,
            'success' => true
        ];

        return response()->json($data);
    }
}
