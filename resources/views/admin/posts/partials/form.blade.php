<div class="form-group">
    {!! Form::label('name','Nombre:') !!}
    {!! Form::text('name', null, ['class' =>'form-control','placeholder'=>'Ingrese el nombre del post']) !!}
    @error('name')
        <small class="text-danger">{{ $message }}</smallc>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('slug','Slug:') !!}
    {!! Form::text('slug', null, ['class' =>'form-control','placeholder'=>'Ingrese el slug del post','readonly']) !!}
    @error('slug')
        <small class="text-danger">{{ $message }}</smallc>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('category_id','Categoria:') !!}
    {!! Form::select('category_id', $categories ,null, ['class' =>'form-control']) !!}
    @error('category_id')
    <small class="text-danger">{{ $message }}</smallc>
@enderror
</div>
<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach ($tags as $tag)
        <label class="mr-2">
            {!! Form::checkbox('tags[]',$tag->id, null) !!}
            {{ $tag->name }}
        </label>
    @endforeach
    @error('tags')
    <br>
    <small class="text-danger">{{ $message }}</small>
@enderror
</div>
<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label>
        {!! Form::radio('status',1,true) !!}
        Borrador
    </label>
    <label>
        {!! Form::radio('status',2) !!}
        Publicado
    </label>
</div>
@error('status')
<br>
<small class="text-danger">{{ $message }}</small>
@enderror
<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
         @isset ($post->image)
            <img id="picture"  src="{{ '/storage/' . $post->image->url }}"alt="">
           @else
            <img id="picture" src="https://cdn.pixabay.com/photo/2021/06/21/20/15/bee-6354562_960_720.jpg" alt="">
         @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file','Imagen que se mostrara en el post') !!}
            {!! Form::file('file', ['class' => 'form-control-file','accept' =>'image/*']) !!}
            @error('file')
                <span href="" class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('extract','Extracto:') !!}
    {!! Form::textarea('extract', null, ['class' =>'form-control']) !!}
</div>
@error('extract')
<small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('body','Cuerpo del post:') !!}
    {!! Form::textarea('body', null, ['class' =>'form-control']) !!}
</div>
@error('body')
<small class="text-danger">{{ $message }}</small>
@enderror