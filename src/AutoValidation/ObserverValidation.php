<?php

namespace ShieldforcePackage\AutoValidation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ObserverValidation
{
    /**
     * @param Model $model
     * @return bool|void
     */
    public function creating(Model $model)
    {
        if(isset($model::$rules['creating']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['creating']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function updating(Model $model)
    {
        if(isset($model['system']) && $model['system']==1)
        {
            return back()
                ->with('error', 'Item não pode ser atualizado!!')
                ->throwResponse();
        }

        if(isset($model::$rules['updating']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['updating']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function retrieved(Model $model)
    {
        if(isset($model::$rules['retrieved']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['retrieved']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function created(Model $model)
    {
        if(isset($model::$rules['created']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['created']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function updated(Model $model)
    {
        if(isset($model::$rules['updated']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['updated']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function saving(Model $model)
    {
        if(isset($model['system']) && $model['system']==1)
        {
            return back()
                ->with('error', 'Item não pode ser atualizado!!')
                ->throwResponse();
        }

        if(isset($model::$rules['saving']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['saving']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function saved(Model $model)
    {
        if(isset($model::$rules['saved']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['saved']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function deleting(Model $model)
    {
        if(isset($model['system']) && $model['system']==1)
        {
            return back()
                ->with('error', 'Item não pode ser deletado!!')
                ->throwResponse();
        }

        if(isset($model::$rules['deleting']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['deleting']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function deleted(Model $model)
    {
        if(isset($model::$rules['deleted']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['deleted']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function restoring(Model $model)
    {
        if(isset($model['system']) && $model['system']==1)
        {
            return back()
                ->with('error', 'Item não pode ser restaurado!!')
                ->throwResponse();
        }

        if(isset($model::$rules['restoring']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['restoring']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }

    /**
     * @param Model $model
     * @return bool|void
     */
    public function restored(Model $model)
    {
        if(isset($model::$rules['restored']))
        {
            $rules = [];
            $validator = Validator::make($model->getAttributes(), $model::$rules['restored']);
            if($validator->fails())
            {
                return back()
                    ->with('error', 'Validação de Campos não passou!!')
                    ->withErrors($validator)
                    ->throwResponse();
            }
        }
        return true;
    }
}
