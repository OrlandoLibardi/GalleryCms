<?php
namespace OrlandoLibardi\GalleryCms\app;
use File;
use OrlandoLibardi\GalleryCms\app\GalleryTemplate;

class ServiceGallery
{

    /**
     * Lê o arquivo de configuração de páginas e retorna o caminho para salvar templates de gallery
     */
    public static function getGalleryPath()
    {
        return config('pages.page_path') . "/gallery/";
    }
    /**
     * Salva o arquivo
     */
    public static function save($name, $content, $id=false)
    {
        $new_content = self::prepareTemplateBlade($content);
        if($id==false){
            $file = self::name($name);
        }else
        {
            $q = GalleryTemplate::find($id)->first();
            $file = $q->template;
        }
        //salva o novo arquivo na pasta final
        File::put(self::getGalleryPath() . $file, $new_content); 
        return $file;
    }
    /**
     * Cria um nome para o arquivo
     */
    public static function name($name)
    {
        return str_slug($name) . ".blade.php";
    }
    /**
     *  Retorna o template para visualização do usuário
     */
    public static function loadTemplate($template)
    {
        return self::prepareTemplateView( File::get( self::getGalleryPath() . $template ) );
    } 
    /**
     *  Retorna o template para visualização do usuário
     */
    public static function deleteTemplate($template)
    {
        return File::delete( self::getGalleryPath() . $template );
    } 
    /**
     * Prepara para o blade
     */
    public static function prepareTemplateBlade($content)
    {        
        $patterns = self::getPatterns();
        $replaces = self::getReplaces();
        return str_replace($patterns, $replaces, $content);
    }
    /**
     * Prepara para o usuário
     */
    public static function prepareTemplateView($content)
    {        
        $patterns = self::getPatterns();
        $replaces = self::getReplaces();
        return str_replace($replaces, $patterns, $content);
    }
    /* patterns */
    public static function getPatterns()
    {
        $patterns[0] = '[';
        $patterns[1] = ']';
        $patterns[2] = 'foreach';
        $patterns[3] = 'endforeach';
        $patterns[4] = 'if';
        $patterns[5] = 'endif';
        $patterns[6] = 'else';
        $patterns[7] = '__';    
        $patterns[8] = 'end@foreach'; 
        $patterns[9] = 'end@if'; 
        $patterns[10] = "extends";
        $patterns[11] = "section";
        $patterns[12] = "endsection";
        $patterns[13] = 'end@section'; 
        $patterns[14] = '_PHP_';
        $patterns[15] = '_END_PHP_';
        $patterns[16] = 'for';
        $patterns[17] = 'endfor';
        $patterns[18] = 'end@for';
        return $patterns;
    }
    /* Replaces */
    public static function getReplaces()
    {
        $replaces[0]  = '{{ ';
        $replaces[1]  = ' }}';
        $replaces[2]  = '@foreach';
        $replaces[3]  = '@endforeach';
        $replaces[4]  = '@if';
        $replaces[5]  = '@endif';
        $replaces[6]  = '@else';
        $replaces[7]  = '$';
        $replaces[8]  = '@endforeach';
        $replaces[9]  = '@endif';        
        $replaces[10] = "@extends";
        $replaces[11] = "@section";
        $replaces[12] = "@endsection";
        $replaces[13] = '@endsection'; 
        $replaces[14] = '@php';
        $replaces[15] = '@endphp';
        $replaces[16] = '@for';
        $replaces[17] = '@endfor';
        $replaces[18] = $replaces[17];
        return $replaces;
    }
}