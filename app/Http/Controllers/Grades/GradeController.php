<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $grades = Grade::all();
        $stages = Stage::all();
        return view('pages.grades.grades', compact('grades', 'stages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreGradeRequest $request)
    {
        //: \Illuminate\Http\RedirectResponse

        $validated = $request->validated();

        try {
            foreach ($request->list_grades as $grade) {

                $grade_obj = new Grade();
                $grade_obj->name = [
                    'en' => $grade['name_en'],
                    'ar' => $grade['name']
                ];
                $grade_obj->stage_id = $grade['stage_id'];
                $grade_obj->save();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(StoreGradeRequest $request)
    {
        try {
            $validated = $request->validated();
            $grade = Grade::findOrFail($request->id);
            $grade->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name
                ],
                'stage_id' => $request->stage_id

            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            Grade::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function deleteAll(Request $request)
    {
        try {
            $ids = explode(",", $request->ids);
            Grade::whereIn('id', $ids)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function filterGrade(Request $request)
    {
        $stages = Stage::all();
        $Search = Grade::select('*')->where('stage_id', '=', $request->stage_id)->get();
        return view('pages.grades.grades', compact('stages'))->withDetails($Search);

    }

}

?>
