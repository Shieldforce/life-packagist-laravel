<?php

namespace App\SaveFilesFunctions;

/**
 * Class ExecuteFunctions
 * @package App\SaveFilesFunctions
 */
trait ExecuteFunctions
{
    /**
     * @param $request
     * @param $inputName
     * @param $caminho
     * @param $largura
     * @param $altura
     * @return bool|string
     */
    public function SalvarImagem($request, $inputName, $caminho, $largura, $altura)
    {
        if($request->hasFile($inputName)){
            $arquivo = $request->file($inputName);
            $filename = time() . '-' . rand() . '.' . $arquivo->getClientOriginalExtension();
            if($arquivo->getClientOriginalExtension() != 'jpg' && $arquivo->getClientOriginalExtension() != 'jpeg' && $arquivo->getClientOriginalExtension() != 'png' && $arquivo->getClientOriginalExtension() != 'PNG' && $arquivo->getClientOriginalExtension() != 'JPG'){
                return false;
            }else{
                Image::make($arquivo)->resize($largura, $altura)->save($caminho.''.$filename);
                return $filename;
            }
        }
        else{
            return false;
        }
    }

    /**
     * @param $request
     * @param $inputName
     * @param $inputNamebanco
     * @param $caminho
     * @param $largura
     * @param $altura
     * @return string
     */
    public function EditarImagem($request, $inputName, $inputNamebanco, $caminho, $largura, $altura)
    {
        if($request->hasFile($inputName)){
            $arquivo = $request->file($inputName);
            $filename = time() . '-' . rand() . '.' . $arquivo->getClientOriginalExtension();
            if($arquivo->getClientOriginalExtension() != 'jpg' && $arquivo->getClientOriginalExtension() != 'jpeg' && $arquivo->getClientOriginalExtension() != 'png' && $arquivo->getClientOriginalExtension() != 'PNG' && $arquivo->getClientOriginalExtension() != 'JPG'){
                return $request->$inputNamebanco;
            }else{
                /*
                //Excluindo arquivo de imagem se ele existir
                if(file_exists($caminho.''.$request->$inputNamebanco) && $request->$inputNamebanco!='')
                {
                    unlink($caminho.''.$request->$inputNamebanco."");
                }
                */
                Image::make($arquivo)->resize($largura, $altura)->save($caminho.''.$filename);
                return $filename;
            }
        }
        else{
            return $request->$inputNamebanco;
        }
    }

    /**
     * @param $nome
     * @param $caminho
     * @return bool
     */
    public function ExcluirImagem($nome, $caminho)
    {
        //Excluindo arquivo de imagem se ele existir
        if(file_exists($caminho.''.$nome) && $nome!='')
        {
            unlink($caminho.''.$nome."");
        }
        return true;
    }

    /**
     * @param Request $request
     * @param $path
     * @param $inputName
     * @return array|string|null
     */
    public function CreateUniqueFile(Request $request, $path, $inputName)
    {
        $nameFile = null;
        if ($request->hasFile($inputName) && $request->file($inputName)->isValid()) {

            $size = $request->$inputName->getClientSize();

            if($size < 10000000) // 5 megas
            {
                $name = uniqid(date('HisYmd'));
                $extension = strtoupper($request->$inputName->extension());
                if
                (
                    $extension=='DOC'    ||
                    $extension=='XLSX'   ||
                    $extension=='PDF'    ||
                    $extension=='TXT'    ||
                    $extension=='JPG'    ||
                    $extension=='JPEG'   ||
                    $extension=='PNG'    ||
                    $extension=='XLS'    ||
                    $extension=='PPT'    ||
                    $extension=='PPTX'
                )
                {
                    $nameFile = "{$name}.{$extension}";
                }
                else
                {
                    return null;
                }
                $upload = $request->$inputName->storeAs($path, $nameFile, 'public');

                if ( !$upload )
                {
                    return $nameFile;
                }
                else
                {
                    return
                        [
                            'nameFile'      => $nameFile,
                            'sizeFile'      => $size,
                            'pathFile'      => $path,
                            'extensionFile' => $extension,
                        ];
                }
            }
        }
        return $nameFile;
    }

    /**
     * @param Request $request
     * @param $path
     * @param $inputName
     * @param array $relation
     * @param $class
     */
    public function UploadFilesToTable(Request $request, $path, $inputName, array $relation, $class)
    {
        if ($request->hasFile($inputName)) {

            foreach ($request['files_all'] as $indice => $file_unique)
            {
                $size = $file_unique->getClientSize();

                if($size < 50000000) // 5 megas
                {
                    $name = uniqid(date('HisYmd'));
                    $extension = strtolower($file_unique->extension());

                    if
                    (
                        $extension=='doc'    ||
                        $extension=='xlsx'   ||
                        $extension=='pdf'    ||
                        $extension=='txt'    ||
                        $extension=='jpg'    ||
                        $extension=='jpeg'   ||
                        $extension=='png'    ||
                        $extension=='xls'    ||
                        $extension=='ppt'    ||
                        $extension=='pptx'
                    )
                    {
                        $nameFile = "{$name}.{$extension}";
                        $upload = $file_unique->storeAs($path, $nameFile, 'public');
                        if($upload)
                        {
                            $table = "\App\Models\Configuration\\$class";
                            if(class_exists($table))
                            {
                                $relation_column = $relation['column'];
                                $store = $table::create([
                                    'user_id'                   => auth()->user()->id,
                                    "$relation_column"          => $relation['id'],
                                    'filename'                  => $nameFile,
                                    'size'                      => $size,
                                    'path'                      => $path,
                                    'extension'                 => $extension,
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param Request $request
     * @param $path
     * @param $inputName
     * @param array $relation
     * @param $class
     */
    public function UploadFilesToTableColumnFilename(Request $request, $path, $inputName, array $relation, $class)
    {
        if ($request->hasFile($inputName)) {

            foreach ($request['files_all'] as $indice => $file_unique)
            {
                $size = $file_unique->getClientSize();

                if($size < 50000000) // 5 megas
                {
                    $name = uniqid(date('HisYmd'));
                    $extension = strtolower($file_unique->extension());

                    if
                    (
                        $extension=='jpg'    ||
                        $extension=='jpeg'   ||
                        $extension=='png'
                    )
                    {
                        $nameFile = "{$name}.{$extension}";
                        $upload = $file_unique->storeAs($path, $nameFile, 'public');
                        if($upload)
                        {
                            $table = "\App\Models\\$class";
                            if(class_exists($table))
                            {
                                $relation_column = $relation['column'];
                                $store = $table::create([
                                    "$relation_column"          => $relation['id'],
                                    'filename'                  => $nameFile,
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param Request $request
     * @param $path
     * @param $inputName
     * @param $relation_ids
     * @param $class
     */
    public function UploadFilesToTableColumnFilenameRelations(Request $request, $path, $inputName, $relation_ids, $class)
    {
        if ($request->hasFile($inputName)) {
            foreach ($request['files_all'] as $indice => $file_unique)
            {
                $size = $file_unique->getClientSize();
                if($size < 50000000) // 5 megas
                {
                    $name = uniqid(date('HisYmd'));
                    $extension = strtolower($file_unique->extension());
                    if
                    (
                        $extension=='jpg'    ||
                        $extension=='jpeg'   ||
                        $extension=='png'
                    )
                    {
                        $nameFile = "{$name}.{$extension}";
                        $upload = Image::make($file_unique)->resize('1000', '563')->save($path.''.$nameFile);
                        if($upload)
                        {
                            $table = "\App\Models\\$class";
                            if(class_exists($table))
                            {
                                $store = $table::create([
                                    'filename'                  => $nameFile,
                                ]);
                                $store->categories()->sync($relation_ids);
                            }
                        }
                    }
                }
            }
        }
    }

}