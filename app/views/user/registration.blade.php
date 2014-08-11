@extends('layout.default')

@section('content')

<h1>Sign up</h1>
<div class="panel panel-default">
    <div class="panel-body">


        {{ Form::open(array('url' => '/user/register', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('firstname', 'Firstname', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('firstname','', array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('lastname', 'Lastname', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('lastname', '', array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('email', 'E-Mail Address', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('email', '', array('class' => 'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Sign up', array('class' => 'btn btn-default')) }}
            </div>
        </div>

        {{ Form::close() }}
    </div>
</div>

@stop