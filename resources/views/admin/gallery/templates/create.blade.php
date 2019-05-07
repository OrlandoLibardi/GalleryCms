@extends('admin.layout.admin') @section( 'breadcrumbs' )
<!-- breadcrumbs -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Galerias</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Paínel de controle</a>
            </li>
            <li><a href="{{ Route('gallery.index') }}">Galerias</a> </li>
            <li><a href="{{ Route('gallery-template.index') }}">Templates</a></li>
            <li class="active">Criar um novo Template </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
        <a href="javascript:savePageTemplate();" class="btn btn-primary btn-sm salvar">Salvar</a>
        <a href="{{ Route('gallery-template.index') }}" class="btn btn-warning btn-sm">Voltar</a>
    </div>
</div>

@endsection @section('content')
<div class="row">
<div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Dados da postagem</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    {!! Form::open(['route' => 'gallery-template.store', 'method' => 'POST', 'id' => 'form-gallery']) !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Nome</label>
                            {!! Form::text('name', null, ['placeholder' =>
                            'Nome do template...','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Template</label>
                            {!! Form::textarea('template', null, ['placeholder' =>
                            'Escreva aqui...','class' => 'form-control', 'id' => 'template']) !!}                            
                        </div>
                        <a class="btn btn-success btn-sm btn-flat btn-set-default" href="javascript:loadTemplate();">Default template</a>
                        <a class="btn btn-success btn-sm btn-flat btn-set-default" href="javascript:boostrapTemplate();">Bootstrap Carousel Template</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('style')
<!-- Adicional Styles -->
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
<!--CodeMirror-->
<link rel="stylesheet" href="{{ asset('assets/theme-admin/js/plugins/codemirror/codemirror.css') }}">
<link rel="stylesheet" href="{{ asset('assets/theme-admin/js/plugins/codemirror/duotone-dark.css') }}">
@endpush
@push('script')
<!-- Adicional Scripts -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/codemirror/mode/clike/clike.js') }}"></script>
<script>
var editor_config = {lineNumbers: true, selectionPointer: true, theme: 'duotone-dark', mode: "text/x-csrc"};
var editor = CodeMirror.fromTextArea(document.getElementById("template"), editor_config);

$(document).ready(function(){
    /*Formulário*/
    $("#form-menu").OLForm({btn : true, listErrorPosition: 'after', listErrorPositionBlock: '.page-heading'}); 

});
    function loadTemplate()
    {
        var obj = "\n";
            obj += 'foreach( __items as __item )'+ "\n";
            obj += ' <img src="[__item->image ]" class="d-block w-100" alt="[__item->title ]">'+ "\n";
            obj += ' [ __item->title ]'+ "\n";
            obj += ' <p>[__item->sub_title ]</p>'+ "\n";
            obj += 'endforeach'+ "\n";

            editor.getDoc().setValue(obj);    
    }

    function boostrapTemplate()
    {
        obj = '<!-- bootstrap model -->'+ "\n";
        obj += '<div id="olcms_template-[__template->id]" class="carousel slide" data-ride="carousel">'+ "\n";
        obj += ' <ol class="carousel-indicators">'+ "\n";      
        obj += '  for (__i = 0; __i < __loop->count; __i++)'+ "\n";
        obj += '  <li data-target="#olcms_template-[__template->id]" data-slide-to="[__i]" class="if(__i==0) active endif"></li>'+ "\n";
        obj += '  endfor'+ "\n";
        obj += ' </ol>'+ "\n";
        obj += ' <div class="carousel-inner">'+ "\n";
        obj += '  foreach( __items as __item )'+ "\n";
        obj += '  <div class="carousel-item if(__loop->index == 0) active endif">'+ "\n";
        obj += '   <img src="[__item->image ]" class="d-block w-100" alt="[__item->title ]">'+ "\n";
        obj += '   <div class="carousel-caption d-none d-md-block">'+ "\n";
        obj += '    <h5>[__item->title ]</h5>'+ "\n";
        obj += '    <p>[__item->sub_title ]</p>'+ "\n";
        obj += '   </div>'+ "\n";
        obj += '  </div>'+ "\n";
        obj += '  endforeach'+ "\n";
        obj += ' </div>'+ "\n";
        obj += ' <a class="carousel-control-prev" href="#olcms_template-[__template->id]" role="button" data-slide="prev">'+ "\n";
        obj += '  <span class="carousel-control-prev-icon" aria-hidden="true"></span>'+ "\n";
        obj += '  <span class="sr-only">Previous</span>'+ "\n";
        obj += ' </a>'+ "\n";
        obj += ' <a class="carousel-control-next" href="#olcms_template-[__template->id]" role="button" data-slide="next">'+ "\n";
        obj += '  <span class="carousel-control-next-icon" aria-hidden="true"></span>'+ "\n";
        obj += '  <span class="sr-only">Next</span>'+ "\n";
        obj += ' </a>'+ "\n";
        obj += '</div>'+ "\n";
        obj += '<!-- ./bootstrap model -->'+ "\n";
        editor.getDoc().setValue(obj); 
    }

    function savePageTemplate(){
        $("textarea[name=template]").val(editor.getDoc().getValue());
        $("#form-gallery").submit();
    }

</script>
@endpush
