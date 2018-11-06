<?php
/**
 * Description of class
 *
 * @author Taffrel Xavier <taffarel_deus@hotmail.com>
 */
class Compactar extends ZipArchive {

    /**
     *
     * @var type 
     */
    public static $zip = null;

    /**
     *
     * @var type 
     */
    public static $nome_do_projeto = null;

    /**
     *
     * @var type 
     */
    private static $dirs = [
        0 => 'bootstrap',
        1 => 'scripts',
        2 => 'classes',
        3 => 'imagens',
        4 => 'img',
        5 => 'modelos',
        6 => 'styles'
    ];

    /**
     * 
     */
    public function __construct($nomeDoProjeto) {

        self::$nome_do_projeto = $nomeDoProjeto;

        self::$zip = new ZipArchive();

        self::salvar($nomeDoProjeto);
    }

    /**
     * 
     * @param type $filename
     * @param type $conteudo
     */
    public static function salvar_arquivo($filename, $conteudo) {

        $file = self::$nome_do_projeto . '.zip';

        //
        if (self::$zip->open($file, ZIPARCHIVE::CREATE) !== TRUE) {
            exit("<label class='text-error'>O arquivo $file não pôde ser aberto. Código <b>1</b></label>.");
        }
        
        echo 'Arquivo criado: <b>', (self::$nome_do_projeto . "/" . $filename), '</b><br/>';

        self::$zip->addFromString(self::$nome_do_projeto . "/" . $filename, $conteudo);
        
    }
/**
 * 
 * @param type $nomeDoProjeto
 */
    public static function salvar($nomeDoProjeto) {

        $filename = $nomeDoProjeto . '.zip';

        //
        if (self::$zip->open($filename, ZIPARCHIVE::CREATE) !== TRUE) {
            exit("cannot open $filename");
        }

        //Cria diretórios
        self::criarDiretorios($nomeDoProjeto);
        //
        self::criarUnicoDiretorio('bootstrap/css/');
        self::criarUnicoDiretorio('bootstrap/font/');
        self::criarUnicoDiretorio('bootstrap/img/');
        self::criarUnicoDiretorio('bootstrap/js/');
        //Adiciona um arquivo e texto:
        //
       
        self::$zip->addFile("../autoload.php", $nomeDoProjeto . "/autoload.php");
        //self::$zip->addFile("../config.ini.php", $nomeDoProjeto . "/config.ini.php");

        //Adicionando arquivo na pasta classes
        self::$zip->addFile("../classes/class.conexao.php", $nomeDoProjeto . "/classes/class.conexao.php");
        self::$zip->addFile("../classes/class.val_input.php", $nomeDoProjeto . "/classes/class.val_input.php");

        //ADD CSS DO BOOSTRAP
        $array_css = [
            'styles/builder.min.css',
            'bootstrap/css/bootstrap.css',
            'bootstrap/css/bootstrap.min.css',
            'bootstrap/css/bootstrap-responsive.css',
            'bootstrap/css/bootstrap-responsive.min.css',
            /*'bootstrap/css/font-awesome.css',
            'bootstrap/css/font-awesome.min.css',
            'bootstrap/css/font-awesome-ie7.css',
            'bootstrap/css/font-awesome-ie7.min.css'*/
        ];

        foreach ($array_css as $value) {
            self::$zip->addFile("../" . $value, $nomeDoProjeto . '/' . $value);
        }

        //ADD FONTS DO BOOSTRAP
        $array_fontes = [
            /*'bootstrap/font/FontAwesome.otf',
            'bootstrap/font/fontawesome-webfont.eot',
            'bootstrap/font/fontawesome-webfont.svg',
            'bootstrap/font/fontawesome-webfont.svgz',
            'bootstrap/font/fontawesome-webfont.ttf',
            'bootstrap/font/fontawesome-webfont.woff'*/
        ];

        foreach ($array_fontes as $value) {
            self::$zip->addFile("../" . $value, $nomeDoProjeto . '/' . $value);
        }


        //ADD IMAGENS DA PASTA IMG DO BOOTSTRAP
        $array_imgs = [
            'bootstrap/img/glyphicons-halflings.png',
            'bootstrap/img/glyphicons-halflings-white.png'
        ];

        foreach ($array_imgs as $value) {
            self::$zip->addFile("../" . $value, $nomeDoProjeto . '/' . $value);
        }

        //self::$zip->addFile("../" . $array_imgs[1], $nomeDoProjeto . '/' . $array_imgs[1]);
        //ADD JAVASCRIPT DA PASTA JS DO BOOTSTRAP
        $array_js = [
            'bootstrap/js/bootstrap.js',
            'bootstrap/js/bootstrap.min.js',
            'scripts/jquery-1.9.1.min.js',
            'scripts/jquery.cookie.js',
            'scripts/jquery.cookie.min.js',
            'scripts/jquery.form.js',
            'scripts/jquery.mask.min.js'
        ];

        foreach ($array_js as $key => $value) {
            self::$zip->addFile("../" . $value, $nomeDoProjeto . '/' . $value);
        }
    }

    /**
     * 
     * @param type $nomeDoProjeto
     */
    private static function criarDiretorios($nomeDoProjeto) {

        self::$zip->addEmptyDir($nomeDoProjeto);

        foreach (self::$dirs as $dir) {
            self::$zip->addEmptyDir($nomeDoProjeto . DIRECTORY_SEPARATOR . $dir);
        }
    }

    /**
     * 
     * @param type $dir
     */
    public static function criarUnicoDiretorio($dir) {
        self::$zip->addEmptyDir(self::$nome_do_projeto . DIRECTORY_SEPARATOR . $dir);
    }

    public static function functionName() {

        $archive_name = "archive.zip"; // name of zip file
        $archive_folder = "folder"; // the folder which you archivate

        $zip = new ZipArchive;
        if ($zip->open($archive_name, ZipArchive::CREATE) === TRUE) {
            $dir = preg_replace('/[\/]{2,}/', '/', $archive_folder . "/");

            $dirs = array($dir);
            while (count($dirs)) {
                $dir = current($dirs);
                $zip->addEmptyDir($dir);

                $dh = opendir($dir);
                while ($file = readdir($dh)) {
                    if ($file != '.' && $file != '..') {
                        if (is_file($file))
                            $zip->addFile($dir . $file, $dir . $file);
                        elseif (is_dir($file))
                            $dirs[] = $dir . $file . "/";
                    }
                }
                closedir($dh);
                array_shift($dirs);
            }

            $zip->close();
            echo 'Archiving is sucessful!';
        }
        else {
            echo 'Error, can\'t create a zip file!';
        }
    }

}

//Compactar::functionName();
//Compactar::$zip->close();
