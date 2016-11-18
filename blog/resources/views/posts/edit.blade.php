@extends('main')
@section('title','Edit Post')

@section('stylesheets')
    {!!    Html::style('css/parsley.css')    !!}
    {!!    Html::style('css/select2.min.css')    !!}
@endsection

@section('content')

<div class="row">
		{!! Form::model($post, ['route' => ['posts.update', $post->id],'data-parsley-validate'=>'', 'method' => 'PUT']) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg','required'=>'','maxlength'=>"255"]) }}
			
            {{ Form::label('slug', 'URL Slug:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('slug', null, ["class" => 'form-control input-lg','required'=>'','minlength'=>"5",'maxlength'=>"255"]) }}

            {{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('category_id',$categories,$post->category_id, ["class" => 'form-control input-lg']) }} 

            {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('tags[]',$tags,null, ["class" => 'form-control input-lg js-example-basic-multiple',"multiple"=>"multiple"]) }}                          

			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control','required'=>'']) }}
		</div>
    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created at:</dt>
                <dd>{{   date('g:i a j M o',strtotime($post->created_at))   }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last updated:</dt>
                <dd>{{   date('g:i a j M o',strtotime($post->updated_at))   }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::LinkRoute('posts.show','Cancel', array($post->id),array('class'=>"btn btn-danger btn-block")) !!}
                </div>
                <div class="col-sm-6">
                    {{ Form::submit('Save Changes',['class'=>"btn btn-success btn-block"]) }}                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    {!!    Html::script('js/parsley.min.js')    !!}
    {!!    Html::script('js/select2.full.min.js')    !!}   

    <script type="text/javascript">
    $(".js-example-basic-multiple").select2();
     $(".js-example-basic-multiple").select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
    </script>        
@endsection
