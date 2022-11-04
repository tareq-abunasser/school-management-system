<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Models\Section;
use App\Models\Stage;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages_with_sections = Stage::with("sections")->get();
        $stages = Stage::all();
        return view('pages.sections.sections', compact('stages', 'stages_with_sections'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionRequest $request)
    {
        try {
            $validate = $request->validated();
            $section = new Section();
            $section->name = [
                "ar" => $request->section_name_ar,
                "en" => $request->section_name_en,

            ];
            $section->stage_id = $request->Stage_id;
            $section->grade_id = $request->grade_id;
            $section->status = 1;

            $section->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSectionRequest $request)
    {

        try {
            $validated = $request->validated();
            $section = Section::findOrFail($request->id);

            $section->name = [
                "ar" => $request->section_name_ar,
                "en" => $request->section_name_en,

            ];
            $section->stage_id = $request->Stage_id;
            $section->grade_id = $request->grade_id;

            if (isset($request->status)) {
                $section->status = 1;
            } else {
                $section->status = 2;
            }

            $section->save();
            toastr()->success(trans('messages.Update'));

            return redirect()->route('sections.index');
        } catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('sections.index');
    }
}
