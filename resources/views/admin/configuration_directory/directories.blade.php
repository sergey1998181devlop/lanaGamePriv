@extends('admin.layouts.app')
@section('page')
    <?php $page = 'directory';$title = "Справочник конфигураций";?>
    <link href="{{ asset('admin/css/configuration_directory/directory.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid ">
        <h1 class="h3 mb-2 text-gray-800">Список конфигураций</h1>
        <ul class="nav nav-tabs py-4">
            @foreach($typeDevicesFirms as $deviceWith)
                <li class="" data-deviceId="{{$deviceWith->id}}">
                    <a class="nav-link {{ $loop->first ? 'active ' : '' }}"  data-typeDevice="{{ $deviceWith->slug }}" data-toggle="tab"
                       href="#{{ $deviceWith->slug }}">{{ $deviceWith->title_device }}</a>
                </li>
            @endforeach

        </ul>
        <form method="POST" action="{{ url('panel/configuration/directory/configuration.save') }}">
            <div class="tab-content ">

                @foreach($resultForView['dataForView'] as $typeDevice => $fields)

                    <div id="{{ $typeDevice }}"
                         class="tab-pane fade {{  $loop->first ? 'in active show' : '' }}">
{{--                        <button type="button" class="btn btn btn-primary addCompany float-right"--}}
{{--                                data-idDraft="{{$deviceWith->id}}" data-toggle="modal"--}}
{{--                                data-target="#addCompany">Добавить фирму--}}
{{--                        </button>--}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="trNameColums">
                                        @if(!empty($optionsForView[$typeDevice]))
                                            @foreach($optionsForView[$typeDevice] as $type)
                                                <th width="80" >
                                                    <div class="typeColumn"> {{ $type }}</div>
                                                    @if($loop->first)
                                                        <i class="fa fa-plus-square  display-5 text-success first-column-btn"
                                                           data-target="#addItems" data-toggle="modal"
                                                           aria-hidden="true"></i>
                                                    @endif
                                                </th>
                                            @endforeach
                                        @endif
                                    </tr>
                                    </thead>

                                    <tbody>

                                                @foreach($fields as $idFields => $messData)

                                                    @if($loop->first)
                                                        <input type="hidden" name="type-first-column" value="{{ $idFields }}">
                                                    @endif



                                                        @foreach($messData as $id => $fieldMess)
                                                            @if($idFields == 'firms' && !array_search($typeDevice , $resultForView['listWithoutDopDataModel'])  )
                                                                <tr>
                                                                    <td data-idFirm="{{$fieldMess['id']}}">{{$fieldMess['title']}}</td>


                                                                    @if(empty($fieldMess['models']))
                                                                        <td class="tdWithDopData">
                                                                            <table>
                                                                                <tbody>
                                                                                <tr>
                                                                            <td data-type="models">
                                                                                <i class="fa fa-plus-square d-flex justify-content-center display-4  text-success add-model add-new-data"
                                                                                   data-target="#addItems" data-toggle="modal"
                                                                                   aria-hidden="true"></i>
                                                                            </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>

                                                                    @endif
                                                                    @if(!empty($fieldMess['models']))
                                                                        <td class="tdWithDopData">
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        @foreach($fieldMess['models'] as $idModel => $model)
                                                                                            @if($loop->index !== 0 && $loop->index % 10 == 0)
                                                                                                </tr>
                                                                                                <tr>
                                                                                            @endif
                                                                                            <td  >{{$model['title']}}</td>
                                                                                                    @if($loop->last)
                                                                                                              <td data-type="models">
                                                                                                                     <i class="fa fa-plus-square d-flex justify-content-center display-4  text-success add-model add-new-data"
                                                                                                                      data-target="#addItems" data-toggle="modal"
                                                                                                                      aria-hidden="true"></i>
                                                                                                              </td>
                                                                                                    @endif
                                                                                        @endforeach
                                                                                        </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endif
                                                            @if($typeDevice == 'ram')
                                                                <tr>
                                                                    @if($idFields == 'types')
                                                                        <td data-type="{{ $idFields }}">{{$fieldMess['title']}}</td>
                                                                        @if($loop->index == 0 )
                                                                            <td rowspan="{{ $loop->count }}" class="tdWithDopData">
                                                                                <table>
                                                                                    <tbody>
                                                                                        @foreach($fields['countMemory'] as $memory)
                                                                                            <td data-type="countMemory" > {{ $memory['title'] }}</td>
                                                                                            @if($loop->last)
                                                                                                <td data-type="countMemory">
                                                                                                    <i class="fa fa-plus-square d-flex justify-content-center display-4  text-success add-model add-new-data"
                                                                                                       data-target="#addItems" data-toggle="modal"
                                                                                                       aria-hidden="true"></i>
                                                                                                </td>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        @endif
                                                                    @endif
                                                                </tr>
                                                            @endif
                                                            @if(array_search($typeDevice , $resultForView['listWithoutDopData']))
                                                                <tr>
                                                                    <td data-type="{{ $idFields }}" >{{$fieldMess['title']}}</td>
                                                                </tr>
                                                            @endif
                                                            @if($typeDevice == 'monitor')
                                                                <tr>
                                                                    @if($idFields == 'firms')
                                                                        <td data-type="{{ $idFields }}">{{$fieldMess['title']}}</td>

                                                                        @if($loop->index == 0 )
                                                                            <td rowspan="{{ $loop->count }}" class="tdWithDopData">
                                                                                <table>
                                                                                    <tbody>
                                                                                    <tr>
                                                                                    @foreach($fields['monitorHertz'] as $memory)
                                                                                            @if($loop->index !== 0 && $loop->index % 2 == 0)
                                                                                                </tr>
                                                                                                <tr>
                                                                                            @endif
                                                                                        <td  > {{ $memory['title'] }}</td>
                                                                                        @if($loop->last)
                                                                                            <td data-type="monitorHertz">
                                                                                                <i class="fa fa-plus-square d-flex justify-content-center display-4  text-success add-model add-new-data"
                                                                                                   data-target="#addItems" data-toggle="modal"
                                                                                                   aria-hidden="true"></i>
                                                                                            </td>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        @endif
                                                                        @if($loop->index == 0 )
                                                                            <td rowspan="{{ $loop->count }}" class="tdWithDopData">
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                    @foreach($fields['monitorInches'] as $memory)
                                                                                            @if($loop->index !== 0 && $loop->index % 2 == 0)
                                                                                                </tr>
                                                                                                <tr>
                                                                                            @endif
                                                                                        <td > {{ $memory['title'] }}</td>
                                                                                        @if($loop->last)
                                                                                            <td data-type="monitorInches" >
                                                                                                <i class="fa fa-plus-square d-flex justify-content-center display-4  text-success add-model add-new-data"
                                                                                                   data-target="#addItems" data-toggle="modal"
                                                                                                   aria-hidden="true"></i>
                                                                                            </td>
                                                                                        @endif
                                                                                    @endforeach
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        @endif
                                                                    @endif
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach


        </form>
    </div>
    <div class="modal fade addItems" id="addItems" tabindex="-1" role="dialog" aria-labelledby="modalLabelAddItems"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelDelDraftHeader">Добавление нового значения<br> с типом - <i class="typeNewVal"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form name="addNewModel" class="addNewData">
                        <input name="typeDevice" type="hidden" value="">
                        <input name="firmId" type="hidden" value="">
                        <input name="idTypeDevice" type="hidden" value="">
                        <input name="typeNewValue" type="hidden" value="">
                        <div class="form-group">
                            <label for="category_id">Новое значение</label>
                            <input name="new_val"
                                   id="new_val"
                                   type="text"
                                   class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn  btn-success deleteDraftButtonModal" data-toggle="modal"
                            data-target="#deleteUser">Добавить</button>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/configuration_directory/directory.js')}}"></script>
@endsection
