@extends(Config::get('usermanager::views.master'))

@section('content')
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-6">
            <section class="module">
                <div class="module-head">
                    <b>{{ $permission->getId() }} - {{ $permission->getName() }}</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="edit-permission-form" method="PUT">
                         <div class="form-group">
                            <label class="control-label">{{ trans('usermanager::all.name') }}</label>
                            <input class="col-lg-12 form-control" type="text" id="name" name="name" value="{{ $permission->getName() }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('usermanager::permissions.value') }}</label>
                            <input class="col-lg-12 form-control" type="text" id="value" name="value" value="{{ $permission->getValue() }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('usermanager::permissions.description') }}</label>
                            <input class="col-lg-12 form-control" type="text" id="description" name="description" value="{{ $permission->getDescription() }}">
                        </div>
                        <br>
                        <div class="form-group">
                            <button id="update-permission" class="btn btn-embossed btn-primary">{{ trans('usermanager::all.update') }}</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop

@section('module_scripts')
<script src="{{ asset('packages/vrigzalejo/usermanager/assets/js/dashboard/permission.js') }}"></script>
@stop
