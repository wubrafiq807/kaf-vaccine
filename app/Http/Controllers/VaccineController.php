<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineRegisterRequest;
use App\Http\Requests\VaccineSearchRequest;
use App\Jobs\VaccineRegistrationJob;
use App\Models\VaccineCenter;
use App\Repository\VaccineRepo;
use Illuminate\Contracts\Support\Renderable;
use Symfony\Component\Console\Input\Input;

class VaccineController extends Controller
{
    protected VaccineRepo $repo;

    /**
     * Create a new controller instance.
     *
     * @param VaccineRepo $repo
     */
    public function __construct(VaccineRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        $data['centers'] = VaccineCenter::all();
        return view('vaccine.register', $data);
    }

    public function store(VaccineRegisterRequest $request)
    {
        VaccineRegistrationJob::dispatchSync($request->all(), $this->repo);
        return redirect()->route('vaccine.create')
            ->with('message', 'Record added successfully!');

    }

    public function search(VaccineSearchRequest $request)
    {
        return back()->withInput()->with('result', $this->repo->search($request->nid));
    }
}
