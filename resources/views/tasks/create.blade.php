@extends('layouts.app')

@section('content')

<h1>タスク新規作成ページ</h1>

 @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
<div class="row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">
{!! Form::model($task, ['route' =>'tasks.store']) !!}
        <form class="form-horizontal">
        <div class="form-group">
        {!! Form::label('content', 'タスク:') !!}
        {!! Form::text('content', null, ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
        {!! Form::label('status', 'ステータス:') !!}
        {!! Form::text('status', null, ['class' => 'form-control']) !!}
        </div>
       

        {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
  </div>
</div>
</form>

@endsection
