@extends('layouts.master')
@section('css')
    @section('title')
        {{ trans('grades_trans.title_page') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('grades_trans.title_page') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('grades_trans.add_Grade') }}
                    </button>

                    <button type="button" class="button x-small"
                            id="btn_delete_all">{{trans('grades_trans.delete_checkbox')}}
                    </button>
                    <br><br>

                    <form action="{{ route('filter') }}" method="POST">
                        @csrf
                        <select class="selectpicker" data-style="btn-info" name="stage_id" required
                                onchange="this.form.submit()">
                            <option value="" selected disabled>{{ trans('stages_trans.search_by_grade') }}</option>
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                            @endforeach
                        </select>
                    </form>
                    <br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox"
                                           onclick="CheckAll('box1', this)"/></th>
                                <th>#</th>
                                <th>{{ trans('grades_trans.name') }}</th>
                                <th>{{ trans('grades_trans.stage_name') }}</th>
                                <th>{{ trans('grades_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if (isset($details))

                                    <?php $grades = $details; ?>
                            @endif

                            <?php $i = 0; ?>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td><input type="checkbox" value="{{ $grade->id }}" class="box1"></td>
                                        <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->stage->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id }}"
                                                title="{{ trans('grades_trans.Edit') }}"><i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}"
                                                title="{{ trans('grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>




                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('grades_trans.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                <form action="{{ route('grades.update', 'test') }}" method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name"
                                                                   class="mr-sm-2">{{ trans('grades_trans.grade_name_ar') }}
                                                                :</label>
                                                            <input id="name" type="text" name="name"
                                                                   class="form-control"
                                                                   value="{{ $grade->getTranslation('name', 'ar') }}"
                                                                   required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $grade->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="name_en"
                                                                   class="mr-sm-2">{{ trans('grades_trans.grade_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{ $grade->getTranslation('name', 'en') }}"
                                                                   name="name_en" required>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('grades_trans.stage_name') }}
                                                            :</label>
                                                        <select class="form-control form-control-lg"
                                                                id="exampleFormControlSelect1" name="stage_id">
                                                            {{--                                                            <option value="{{  $grade->stage->id  }}">--}}
                                                            {{--                                                                {{ $grade->stage->name }}--}}
                                                            {{--                                                            </option>--}}
                                                            {{--                                                            @foreach ($stages as $stage)--}}
                                                            {{--                                                                <option value="{{ $stage->id }}">--}}
                                                            {{--                                                                    {{ $stage->name }}--}}
                                                            {{--                                                                </option>--}}
                                                            {{--                                                            @endforeach--}}
                                                            <option value="{{ $grade->stage->id }}">
                                                                {{ $grade->stage->name }}
                                                            </option>
                                                            @foreach ($stages as $stage)
                                                                @if( $grade->stage->id != $stage->id)
                                                                    <option value="{{ $stage->id }}">
                                                                        {{ $stage->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('grades_trans.delete_class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('grades.destroy', 'test') }}"
                                                      method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    {{ trans('grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $grade->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('grades_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('grades_trans.add_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('grades.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="list_grades">
                                        <div data-repeater-item>

                                            <div class="row">

                                                <div class="col">
                                                    <label for="name"
                                                           class="mr-sm-2">{{ trans('grades_trans.grade_name_ar') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="name" required/>
                                                </div>


                                                <div class="col">
                                                    <label for="name_en"
                                                           class="mr-sm-2">{{ trans('grades_trans.grade_name_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="name_en"
                                                           required/>
                                                </div>


                                                <div class="col">
                                                    <label for="stage_id"
                                                           class="mr-sm-2">{{ trans('grades_trans.stage_name') }}
                                                        :</label>

                                                    <div class="box">
                                                        <select class="fancyselect" name="stage_id">
                                                            @foreach ($stages as $stage)
                                                                <option
                                                                    value="{{ $stage->id }}">{{ $stage->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="processes"
                                                           class="mr-sm-2">{{ trans('grades_trans.Processes') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                           type="button"
                                                           value="{{ trans('grades_trans.delete_Grade') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button"
                                                   value="{{ trans('grades_trans.add_Grade') }}"/>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </div>

    <!-- حذف مجموعة صفوف -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('grades_trans.delete_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('delete-all') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        {{ trans('grades_trans.Warning_Grade') }}
                        <input class="text" type="text" id="delete_all_id" name="ids" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('grades_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = new Array();
                $("#datatable td input[type=checkbox]:checked").each(function () {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>

@endsection
