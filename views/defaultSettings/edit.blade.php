@section('page_title')
    <h2>{{xe_trans('board::boardDetailConfigures')}}</h2>
@endsection

@section('page_description')
@endsection

{{ Frontend::js('plugins/board/assets/js/managerSkin.js')->load() }}

<!-- Main content -->
<section class="content __xe_sections bbbb">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <!-- Board config boxx -->
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <p class="txt_tit">{{xe_trans('board::boardDetailConfigures')}}</p>

                <div class="right_btn pull-right" role="button" data-toggle="collapse" data-parent="#accordion" data-target="#boardSection">
                    <!-- [D] 메뉴 닫기 시 버튼 클래스에 card_close 추가 및 item_container none/block 처리-->
                    <button class="btn_clse ico_gray pull-left"><i class="xi-angle-down"></i><i class="xi-angle-up"></i><span class="blind">{{xe_trans('xe::menuClose')}}</span></button>
                </div>
            </div>
        </div>
        <div id="boardSection" class="panel-collapse collapse in" role="tabpanel">
            <div class="panel-body panel-collapse collapse in">
            <form method="post" id="board_manage_form" action="{!! $urlHandler->managerUrl('update', ['boardId' => $boardId]) !!}">

                <input type="hidden" name="_token" value="{{{ Session::token() }}}">

                <div class="form-group">
                    <label for="">{{xe_trans('board::perPage')}}</label>
                    <p class="desc-text">{{xe_trans('board::perPageDescription')}}</p>
                    <input type="text" id="" name="perPage" class="form-control" value="{{Input::old('perPage', $config->get('perPage'))}}" />
                </div>

                {{--<div class="form-group">--}}
                    {{--<label for="">{{xe_trans('board::perPageForSearch')}}</label>--}}
                    {{--<p class="desc-text">{{xe_trans('board::perPageForSearchDescription')}}</p>--}}
                    {{--<input type="text" id="" name="searchPerPage" class="form-control" value="{{Input::old('searchPerPage', $config->get('searchPerPage'))}}" />--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<label for="">{{xe_trans('board::pageLinkCount')}}</label>--}}
                    {{--<p class="desc-text">{{xe_trans('board::pageLinkCountDescription')}}</p>--}}
                    {{--<input type="text" id="" name="pageCount" class="form-control" value="{{Input::old('pageCount', $config->get('pageCount'))}}" />--}}
                {{--</div>--}}

                <div class="form-group">
                    <label for="">{{xe_trans('board::newArticleTime')}}</label>
                    <p class="desc-text">{{xe_trans('board::newArticleTimeDescription')}}</p>
                    <input type="text" id="" name="newTime" class="form-control" value="{{Input::old('newTime', $config->get('newTime'))}}" />
                </div>

                <div class="form-group">
                    <label for="">{{xe_trans('xe::comment')}}</label>
                    <select id="" name="comment" class="form-control">
                        <option value="true" {!! $config->get('comment') == true ? 'selected="selected"' : '' !!} >Use</option>
                        <option value="false" {!! $config->get('comment') == false ? 'selected="selected"' : '' !!} >Disuse</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">{{xe_trans('xe::recommend')}}</label>
                    <select id="" name="assent" class="form-control">
                        <option value="true" {!! $config->get('assent') == true ? 'selected="selected"' : '' !!} >Use</option>
                        <option value="false" {!! $config->get('assent') == false ? 'selected="selected"' : '' !!} >Disuse</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">{{xe_trans('xe::discommend')}}</label>
                    <select id="" name="dissent" class="form-control">
                        <option value="true" {!! $config->get('dissent') == true ? 'selected="selected"' : '' !!} >Use</option>
                        <option value="false" {!! $config->get('dissent') == false ? 'selected="selected"' : '' !!} >Disuse</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">{{xe_trans('board::anonymityUse')}}</label>
                    <select id="" name="anonymity" class="form-control">
                        <option value="true" {!! $config->get('anonymity') == true ? 'selected="selected"' : '' !!} >Use</option>
                        <option value="false" {!! $config->get('anonymity') == false ? 'selected="selected"' : '' !!} >Disuse</option>
                    </select>
                </div>

                {{--<div class="form-group">--}}
                    {{--<label for="">짧은 주소 사용</label>--}}
                    {{--<p class="desc-text">Short uuid를 이용한 짧은 주소 사용</p>--}}
                    {{--<select id="" name="shortId" class="form-control">--}}
                        {{--<option value="true" {!! $config->get('shortId') == true ? 'selected="selected"' : '' !!} >Use</option>--}}
                        {{--<option value="false" {!! $config->get('shortId') == false ? 'selected="selected"' : '' !!} >Disuse</option>--}}
                    {{--</select>--}}
                {{--</div>--}}

                <div class="form-group">
                    <label for="">{{xe_trans('xe::orderType')}}</label>
                    <p></p>
                    <select id="" name="order" class="form-control" onchange="$(this).parent().find('p').html(($(this).find(':selected').attr('description')))">
                        @foreach($boardOrders as $key => $boardOrder)
                            <option value="{{$key}}" description="{{xe_trans($boardOrder->description())}}" {!! $config->get('order') == $key ? 'selected="selected"' : '' !!}>{{xe_trans($boardOrder->name())}}</option>
                        @endforeach
                    </select>
                </div>

                {{--<div class="form-group">--}}
                    {{--<label>{{xe_trans('board::addon')}}</label>--}}
                    {{-- set variables */ $i=0 /*--}}
                    {{--@foreach($addons as $key=>$addon)--}}
                    {{--<div class="checkbox">--}}
                        {{--<label>--}}
                            {{--<input type="checkbox" value="{{$key}}" name="addons[{{$i++}}]" {!! in_array($key, $config->get('addons') != null ? $config->get('addons') : []) === true ? 'checked="checked"' : '' !!} />--}}
                            {{--<span title="{{$addon->getId()}}">{{$addon->name()}}</span>--}}
                            {{--@if ($addon->getConfigUrl($config)) <a class="manage-link" href="{!!$addon->getConfigUrl($config) !!}" target="_blank">{{xe_trans('xe::manage')}}</a> @endif--}}
                            {{--<span class="desc-text">{!!$addon->description()!!}</span>--}}

                        {{--</label>--}}
                    {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}

                <div class="form-group">
                    <label for="">{{xe_trans('board::adminEmail')}}</label>
                    <p class="desc-text">{{xe_trans('board::adminEmailDescription')}}</p>
                    <input type="text" name="managerEmail" class="form-control" value="{{ Input::old('managerEmail', $config->get('managerEmail')) }}" />
                </div>

                <div class="form-group">
                    <label for="">{{xe_trans('xe::list')}}</label>
                    <div class="form-inline">
                        <div class="form-group">
                            <select class="form-control" id="list_options" size="8" multiple="multiple">
                                @foreach ($listOptions as $columnName)
                                    <option value="{{$columnName}}">{{$columnName}}</option>
                                @endforeach
                            </select>
                            <div>
                                <button type="button" class="btn btn-default list-option-add">추가</button>
                            </div>

                        </div>
                        <div class="form-group">
                            <select class="form-control" id="list_selected" size="8" multiple="multiple">
                                @foreach ($listColumns as $columnName)
                                    <option value="{{$columnName}}">{{$columnName}}</option>
                                @endforeach
                            </select>
                            <div>
                                <button type="button" class="btn btn-default list-option-up">위로</button>
                                <button type="button" class="btn btn-default list-option-down">아래로</button>
                                <button type="button" class="btn btn-default list-option-delete">삭제</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">{{xe_trans('xe::input')}}</label>
                    <div class="form-group">
                        <select class="form-control" id="form_order" size="8" multiple="multiple">
                            @foreach ($formColumns as $columnName)
                                <option value="{{$columnName}}">{{$columnName}}</option>
                            @endforeach
                        </select>
                        <div>
                            <button type="button" class="btn btn-default form-order-up">위로</button>
                            <button type="button" class="btn btn-default form-order-down">아래로</button>
                        </div>
                    </div>
                </div>

                <!-- Permission -->
                @foreach ($perms as $perm)
                    <div class="form-group">
                        <label for="">{{ $perm['title'] }} {{xe_trans('xe::permission')}}</label>
                        <div class="well">
                            {!! uio('permission', $perm) !!}
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">{{xe_trans('xe::save')}}</button>
            </form>
            <script>
                $(function() {
                    $('#board_manage_form').bind('submit', function() {
                        $('#list_selected option').each(function() {
                            var listColumn = $('<input>').attr('name', 'listColumns[]').val($(this).val()).attr('type', 'hidden');
                            $('#board_manage_form').append(listColumn);
                        });

                        $('#form_order option').each(function() {
                            var listColumn = $('<input>').attr('name', 'formColumns[]').val($(this).val()).attr('type', 'hidden');
                            $('#board_manage_form').append(listColumn);
                        });
                    });
                });
            </script>
            </div>
        </div>
    </div>

    <!-- Skin config box -->
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <p class="txt_tit">{{xe_trans('xe::skin')}}</p>

                <div class="right_btn pull-right" role="button" data-toggle="collapse" data-parent="#accordion" data-target="#skinSection">
                    <!-- [D] 메뉴 닫기 시 버튼 클래스에 card_close 추가 및 item_container none/block 처리-->
                    <button class="btn_clse ico_gray pull-left"><i class="xi-angle-down"></i><i class="xi-angle-up"></i><span class="blind">{{xe_trans('xe::menuClose')}}</span></button>
                </div>

            </div>
        </div>
        <div id="skinSection" class="panel-collapse collapse" role="tabpanel">
            <div class="panel-body panel-collapse collapse in">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        {!! $skinSection !!}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- DynamicField config box -->
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <p class="txt_tit">{{xe_trans('xe::dynamicField')}}</p>

                <div class="right_btn pull-right" role="button" data-toggle="collapse" data-parent="#accordion" data-target="#dynamicFieldSection">
                    <!-- [D] 메뉴 닫기 시 버튼 클래스에 card_close 추가 및 item_container none/block 처리-->
                    <button class="btn_clse ico_gray pull-left"><i class="xi-angle-down"></i><i class="xi-angle-up"></i><span class="blind">{{xe_trans('xe::menuClose')}}</span></button>
                </div>

            </div>
        </div>
        <div id="dynamicFieldSection" class="panel-collapse collapse" role="tabpanel">
            <div class="panel-body panel-collapse collapse in">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        {!! $dynamicFieldSection !!}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ToggleMenu config box -->
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <p class="txt_tit">{{xe_trans('xe::toggleMenu')}}</p>

                <div class="right_btn pull-right" role="button" data-toggle="collapse" data-parent="#accordion" data-target="#toggleMenuSection">
                    <!-- [D] 메뉴 닫기 시 버튼 클래스에 card_close 추가 및 item_container none/block 처리-->
                    <button class="btn_clse ico_gray pull-left"><i class="xi-angle-down"></i><i class="xi-angle-up"></i><span class="blind">{{xe_trans('xe::menuClose')}}</span></button>
                </div>

            </div>
        </div>
        <div id="toggleMenuSection" class="panel-collapse collapse" role="tabpanel">
            <div class="panel-body panel-collapse collapse in">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        {!! $toggleMenuSection !!}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Comment config box -->
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <p class="txt_tit">{{xe_trans('xe::comment')}}</p>

                <div class="right_btn pull-right" role="button" data-toggle="collapse" data-parent="#accordion" data-target="#commentSection">
                    <!-- [D] 메뉴 닫기 시 버튼 클래스에 card_close 추가 및 item_container none/block 처리-->
                    <button class="btn_clse ico_gray pull-left"><i class="xi-angle-down"></i><i class="xi-angle-up"></i><span class="blind">{{xe_trans('xe::menuClose')}}</span></button>
                </div>

            </div>
        </div>
        <div id="commentSection" class="panel-collapse collapse" role="tabpanel">
            <div class="panel-body panel-collapse collapse in">
                @if($config->get('comment') == true)
                    {!! $commentSection !!}
                @else
                    {{xe_trans('xe::disUse')}}
                @endif
            </div>
        </div>
    </div>
</div>
</section>

{!! uio('uiobject/xpressengine@chakIt', 'Settings:게시판') !!}

