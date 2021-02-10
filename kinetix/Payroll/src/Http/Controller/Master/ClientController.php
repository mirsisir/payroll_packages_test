<?php

namespace kinetix\payroll\Http\Controller\Master;

use kinetix\payroll\Http\Controller\Controller;
use kinetix\payroll\Models\License;
use kinetix\payroll\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::query()->whereRole('Client')->paginate(20);
        return view('master.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {


        $data = $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'license_id' => 'nullable',
        ]);
//        dd($data);

        $data["password"] = Hash::make($data["password"]);
        if ($request->has('license_id')) {
            $license = License::query()->where('license', $data['license_id'])->where('is_used', false);
            if ($license->count() > 0) {
                $l = $license->first();
                $data['license_id'] = $l->id;
                $l->is_used = true;
                $l->save();
            } else {
                $data['license_id'] = null;
            }
        }

        $client = User::create($data);
        $client->client_id = $client->id;
        $client->save();
//        dd($client);


//        dd('works', $request->all());
        return redirect()->route('clients.index');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
