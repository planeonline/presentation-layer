@extends('layout.default')

@section('content')

<h1>Sign up</h1>


@if (count($errors)>0)
<div class="alert alert-danger" role="alert">
    <strong>There were something wrong with the provided information:</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif




<div class="panel panel-default">

    <div class="panel-body">


        {{ Form::open(array('url' => '/user/registration', 'class' => 'form-horizontal')) }}

        <div class="form-group {{ isset($failedFields) && in_array('firstname',$failedFields)? 'alert-warning' :''}}">
            {{ Form::label('firstname', 'Firstname', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('firstname', isset($data)? $data['firstname']:'', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ isset($failedFields) && in_array('lastname',$failedFields)? 'alert-warning' :''}}">
            {{ Form::label('lastname', 'Lastname', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('lastname', isset($data)? $data['lastname']:'', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ isset($failedFields) && in_array('email',$failedFields)? 'alert-warning' :''}}">
            {{ Form::label('email', 'E-Mail Address', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::text('email', isset($data)? $data['email']:'', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ isset($failedFields) && in_array('password',$failedFields)? 'alert-warning' :''}}">
            {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ isset($failedFields) && in_array('password-confirm',$failedFields)? 'alert-warning' :''}}">
            {{ Form::label('password_confirmation', 'Confirm Pass', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
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