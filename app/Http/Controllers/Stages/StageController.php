<?php

namespace App\Http\Controllers\Stages;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStageRequest;
use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class StageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $stages = Stage::all();

        return view('pages.stages.stages', compact('stages'));
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
    public function store(StoreStageRequest $request)
    {

//        if (Stage::where('name->ar', $request->name)->orWhere('name->en', $request->name_en)->exists()) {
//            return redirect()->back()->withErrors(trans("stages_trans.exists"));
//        }
        try {
            $validated = $request->validated();
            Stage::create([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name
                ],
                'notes' => $request->notes

            ]);
//        $stage = new Stage();
//        $stage->name = [
//            'en' => $request->name_en,
//            'ar' => $request->name
//        ];
//
//        $stage->notes = $request->notes;
//
//        $stage->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('stages.index');
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
    public function update(StoreStageRequest $request)
    {
        try {
            $validated = $request->validated();
            $stage = Stage::findOrFail($request->id);
            $stage->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name
                ],
                'notes' => $request->notes

            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('stages.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $stage = Stage::findOrFail($request->id);
            $grades = $stage->grades;
//            $grades = Grade::where('stage_id',$request->id)->pluck('grade_id');
            if (count($grades) != 0) {
                toastr()->error("warning this stage contains " . count($grades) . " grades you must delete its grades first");
                return redirect()->route('stages.index');
            }
            $stage->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



}
