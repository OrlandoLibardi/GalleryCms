@extends('admin.layout.admin') @section( 'breadcrumbs' )
<!-- breadcrumbs -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Galerias</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Paínel de controle</a>
            </li>
            <li>
                <a href="{{ Route('gallery.index') }}">Galerias</a>
            </li>
            <li class="active">
                Galerias Cadastradas
            </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
            <a href="{{ Route('gallery.index') }}" class="btn btn-warning btn-sm">Voltar</a>
    </div>
</div>

@endsection 
@section('content')
<div class="row">
    
  
</div>
@endsection
@push('style')
<!-- Adicional Styles -->
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
<style>
    .typeahead {
        z-index: 1051;
    }

    ul.typeahead.dropdown-menu {
        width: 100%;
        border-radius: 0px;
    }

    ul.typeahead.dropdown-menu li.active a {
        background: none;
        color: #999;
    }
</style>
@endpush
@push('script')
<!-- Adicional Scripts -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<!-- typeahead -->
<script src="{{ asset('assets/theme-admin/js/plugins/bootstrap3-typeahead/bootstrap3-typeahead.js') }}"></script>
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>
<script>

    /*
    * TypeaHead - autocomplete for input title
    */    
    var all_pages = @php /*echo json_encode($pages)*/ @endphp;

    var $input = $(".typeahead");
    $input.typeahead({
        source: all_pages,
        autoSelect: true
    });

    $input.change(function () {
        var current = $input.typeahead("getActive");
        if (current) {
            if (current.name == $input.val()) {
                $("input[name=url]").val( '/' + current.alias )
            }
        }
    });

    @can('delete')
    /*
    * Exclude
    */
    $("#results").OLExclude({'action' : "{{ Route('menu-items.destroy', [ 'id' => 1 ]) }}", 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'}, reloadOptions);    
    @endcan
    
    /*
    * Order
    */
    window.tempVars = [];    
    $(document).on("click", "input.orderChange", function(){
            ro  = $(this).prop('readonly');
            $(this).prop('readonly', !ro).focus();
            window.tempVars[$(this).attr("data-id")] = $(this).val();
            $(this).val("");
    });
    $(document).on("blur", "input.orderChange", function(e){		
        ro  = $(this).prop('readonly');
        $(this).prop('readonly', !ro);
        if($(this).val().length == 0 || $(this).val() == tempVars[$(this).attr("data-id")])
        { 
            $(this).val(tempVars[$(this).attr("data-id")]);
        }else
        {
           sendOrder($(this).attr("data-id"), $(this).val());
        }	
    });
    
    $("#update-order").OLForm({btn : true, listErrorPosition: 'after', listErrorPositionBlock: '.page-heading' }, newOrder);

    function sendOrder(id, order) {
        $("#update-order input[name=order]").val(order);
        $("#update-order input[name=id]").val(id);
        $("#update-order").submit();

    }
    function newOrder() {

    }
    function reloadOptions() {
        setTimeout(function(){ removeItems()}, 1000);
    }

    function removeItems(){

        var ativos = [], options = [];
        
        $('.table').find('input[name=exclude]').each(function(){
            ativos.push($(this).val());
        });

        $("select[name=parent_id]").find('option').each(function(){
            if($(this).val() > 0 )
            {
                options.push($(this).val());
            }
        });

        var diff = arr_diff(ativos, options);
        if(diff.length > 0)
        {
            for(key in diff)
            {
                $("select[name=parent_id] option[value="+diff[key]+"]").remove();
                console.log("Removido ",  diff[key]);
            }
        }

    }
     
    function arr_diff (a1, a2) {

        var a = [], diff = [];

        for (var i = 0; i < a1.length; i++) {
            a[a1[i]] = true;
        }

        for (var i = 0; i < a2.length; i++) {
            if (a[a2[i]]) {
                delete a[a2[i]];
            } else {
                a[a2[i]] = true;
            }
        }

        for (var k in a) {
            diff.push(k);
        }

        return diff;
        }
    

</script>

@endpush