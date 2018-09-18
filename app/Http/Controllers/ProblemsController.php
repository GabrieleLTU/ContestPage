<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProblemsController extends Controller
{
    private $problem;

    public function __construct(Problem $problem)
    {
        $this->problem = $problem;
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * ::all()
     * ::orderBy('created_at','desc')->take(1)->get()
     * ::orderBy('created_at','desc')->get()
     * ::orderBy('column_name','asc/asc')->get()
     * ::where('column_name', 'meaning')->get()
     * DB::SELECT('SELECT * FROM table_name) + need use DB;
     */

    public function index()
    {
        if (!auth()->guest()) {
            $problems = $this->problem->getProblems(auth()->User()->is_admin);
        } else {
            $problems = $this->problem->getProblems(false);
        }

        $data = array(
            'name' => $this->problem::TABLE_NAME,
            'items' => $problems['ready']
        );

        if(isset($problems['not_ready'])){
            $data['sec_name'] = 'not ready problems';
            $data['sec_items'] = $problems['not_ready'];
        }

        return view('problems.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->User()->is_admin) {
            return view('problems.create');
        } else {
            return redirect('/problems');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->User()->is_admin) {
            $this->validate($request, [
                'title' => 'required|string',
                'condition' => 'required|string',
                'answer' => 'required|string'
            ]);

            $request['user_id'] = auth()->User()->id;

            if($this->problem->createProblem($request->toArray()))
            {
                return redirect('/problems')->with('success', 'Problem created');
            } else {
                return redirect()->back()->withInput()->with('error', $this->problem->getErrors());
            }
        }
        return redirect('/problems')->with('error','You do not have permission to do that.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$problem = Problem::find($id);
        $problem = $this->problem->getProblem($id);
        return view('problems.show')->with('problem', $problem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->User()->is_admin) {
            return view('problems.edit')->with('problem', $this->problem->getProblem($id));
        }
        return redirect('/problems');
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
        if (auth()->User()->is_admin) {
            $this->validate($request, [
                'title' => 'required|string',
                'condition' => 'required|string',
                'answer' => 'required|string'
            ]);

            foreach ($request->toArray() as $key => $value){
                if($key != "_token" && $key != "_method")
                {
                    $attributeToUpdate[$key] = $value;
                }
            }
            $attributeToUpdate['user_id'] = auth()->User()->id;
            //return $attributeToUpdate;
            $laik = $this->problem->updateProblem($attributeToUpdate, $id);

//            $problem = Problem::find($id);
//            $problem->title = $request->input('title');
//            $problem->condition = $request->input('condition');
//            $problem->answer = $request->input('answer');
//            $problem->is_ready = is_null($request->input('is_ready'))?false:true;
//            $problem->contest_id = null;//$request->input('title');
//            $problem->user_id = auth()->user()->id;
//            $problem->save();
            if ($laik)
            {
                return redirect('/problems')->with('success', 'Problem updated');
            } else {
                return redirect()->back()->withInput()->with('error', $this->problem->getErrors());

            }
        }
        return redirect('/problems');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->User()->is_admin) {
            $this->problem->deleteProblem($id);
            return redirect('/problems')->with('success', 'Problem was deleted');
        }
        return redirect('/problems');
    }
}
