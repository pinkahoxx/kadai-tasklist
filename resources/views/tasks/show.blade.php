@extends('layouts.app')

@section('content')

<h1>id={{$task->id}}のタスク詳細ページ</h1>
<p>タスク:{{ $task->content }}</p>
<P>ステータス:{{ $task->status }}</P>


 {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $task->id]) !!}

{!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除') !!}
    {!! Form::close() !!}
@endsection
