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
            <li class="active">Templates </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
        @can('create')
        <a href="{{ Route('gallery-template.create') }}" class="btn btn-success btn-sm">Novo Template</a>
        @else
        <a href="javascript:;" class="btn btn-success btn-sm disabled alert-action">Novo Template</a>
        @endcan
    </div>
</div>

@endsection @section('content')

<div class="row">
    <div class="col-md-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Menus cadastradas</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="results">
                            <thead>
                                <tr>
                                    <td width="10"><input type="checkbox" name="excludeAll"></td>
                                    <td>Nome</td>
                                    <td width="200">Template</td>
                                    <td width="300">Usage</td>
                                    <td width="150">Criado em:</td>
                                    <td width="150">Atualizado em:</td>
                                    <td width="50">Editar</td>
                                </tr>
                            </thead>
                            <tbody>
                                @can('edit')
                                @foreach ($template as $template)
                                    <tr>
                                        <td><input type="checkbox" name="exclude" value="{{ $template->id }}"> </td>
                                        <td>{{ $template->name }}</td>
                                        <td>{{ $template->template }}</td>
                                        <td>&#123;!! OlCmsGallery::show('{{$template->alias}}', 'id_gallery') !!&#125;</td>
                                        <td>{{ $template->created_at }}</td>
                                        <td>{{ $template->updated_at }}</td>
                                        <td class="text-center">
                                            @include('admin.includes.btn_edit', ['route' => route('gallery-template.edit', ['id' => $template->id])])
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                @foreach ($template as $template)
                                    <tr>
                                        <td><input type="checkbox" name="exclude" value="{{ $template->id }}"> </td>
                                        <td>{{ $template->name }}</td>
                                        <td>{{ $template->template }}</td>
                                        <td>&#123;!! OlCmsGallery::show('{{$template->alias}}', 'id_gallery') !!&#125;</td>
                                        <td>{{ $template->created_at }}</td>
                                        <td>{{ $template->updated_at }}</td>
                                        <td class="text-center">
                                            @include('admin.includes.btn_edit_disabled', ['route' => route('gallery-template.edit', ['id' => $template->id])])
                                        </td>
                                    </tr>
                                @endforeach
                                @endcan
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<input name="route_delete" value="gallery-template/destroy/0" type="hidden">
@endsection
@push('style')
<!-- Adicional Styles -->
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
@endpush
@push('script')
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>
<script>
/*Exclude*/
$("#results").OLExclude({'action' : $("input[name=route_delete]").val(), 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});

</script>

@endpush
