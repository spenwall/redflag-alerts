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
     * get the posts for an alert
     * 
     */
    public function posts($alertId)
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        //validate requried and unique
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

        $alert = new Alert(['name' => $request->name, 
                            'user_id' => $user->id, 
                            'keywords' => $request->keywords]);
        $alert->save();
        $user = $user->fresh();
        $alerts = $user->alerts;
        return view('alerts', ['alerts' => $alerts]);
    }

    /**
     * Return the users alerts as json
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function alerts()
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
}