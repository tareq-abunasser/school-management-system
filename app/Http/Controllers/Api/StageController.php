<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStageRequest;
use App\Http\Resources\StageResource;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StageController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $stages = StageResource::collection(Stage::all());
        return $this->api_response($stages, 'ok', 200);
    }

    public function show($id)
    {
        $stage = Stage::find($id);
        if ($stage)
            return $this->api_response(new StageResource($stage), 'ok', 200);

        return $this->api_response(null, 'this stage not found', 400);

    }

    public function store(StoreStageRequest $request)
    {

        $validated = $request->validated();
//
//        if ($validated->fails()) {
//            return $this->api_response(null, $validated->errors(), 400);
//
//        }


//        $validator = Validator::make($request->all(),[
//            'name' => 'required|unique:stages,name->ar,' . $request->id,
//            'name_en' => 'required|unique:stages,name->en,' . $request->id,
//        ]);
//        if ($validator->fails()) {
//            return $this->api_response(null, $validator->errors(), 400);
//
//        }
        $stage = Stage::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name
            ],
            'notes' => $request->notes

        ]);

        if ($stage)
            return $this->api_response(new StageResource($stage), 'stage saved', 201);

        return $this->api_response(null, 'this stage not save', 404);

    }

    public function update(StoreStageRequest $request,$id)
    {
        $validated = $request->validated();
        $stage = Stage::find($id);
        if (!$stage)
            return $this->api_response(null, 'this stage dose not exists', 404);

        $stage->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name
            ],
            'notes' => $request->notes

        ]);
        if ($stage)
            return $this->api_response(new StageResource($stage), 'stage updated', 201);
        return $this->api_response(null, 'this stage not updated', 404);

    }

    public function destroy($id)
    {
        try {
            $stage = Stage::findOrFail($id);
            $grades = $stage->grades;
//            $grades = Grade::where('stage_id',$request->id)->pluck('grade_id');
            if (count($grades) != 0) {
                return $this->api_response(null, "warning this stage contains " . count($grades) . " grades you must delete its grades first", 404);
            }
            $stage->delete();
            return $this->api_response(new StageResource($stage), 'stage deleted', 200);
        } catch (\Exception $e) {
            return $this->api_response(null, $e->getMessage(), 404);
        }

    }
}
