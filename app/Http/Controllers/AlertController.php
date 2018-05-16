<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Alert;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlertController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Respons
     */
    public function index()
    {
        //
        $user = Auth::user();
        $alerts = $user->alerts;

        
        return view('alerts', ['alerts' => $alerts, 'duplicate' => false]);
    }

    /**
     * get the results for an alert
     * 
     */
    public function results($alertId)
    {
        if (is_null(Alert::find($alertId))) {
            return ['error' => 'Alert Not Found'];
        }
        $alert = Alert::find($alertId);
        
        return Post::search($alert->keywords)->get();
    }

    public function delete($alertId)
    {
        $user = Auth::user();

        return Alert::where(['user_id' => $user->id, 'id' => $alertId])->delete();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-alert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        //validate
        $request->validate([
            'name' => ['required',
                        Rule::unique('Alerts')->where(function ($query) use($user){
                           return $query->where('user_id', $user->id);
                        })
                    ],
            'keywords' => ['required',
                            Rule::unique('Alerts')->where(function ($query) use($user){
                                return $query->where('user_id', $user->id);
                            })
                        ]
        ]);

        //check for duplicates too
        $alert = new Alert(['name' => $request->name, 
                            'user_id' => $user->id, 
                            'keywords' => $request->keywords]);
        $alert->save();
        $user = $user->fresh();
        $alerts = $user->alerts;
        return view('alerts', ['alerts' => $alerts]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        
        return $user->alerts()->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function edit(Alert $alert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alert $alert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alert $alert)
    {
        //
    }
}
