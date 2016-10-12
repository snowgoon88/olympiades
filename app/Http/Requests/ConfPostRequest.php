<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Barryvdh\Debugbar\Facade as Debugbar;

class ConfPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //DEBUG print( "ConfPostRequest::auth<br/>" );
        //DEBUG Debugbar::info( "ConfPostRequest::auth" );
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //DEBUG print( "ConfPostRequest::rules<br/>" );
        return [
            //
        ];
    }
    /**
     * Get the validator instance for the request and 
     * add attach callbacks to be run after validation 
     * is completed.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        //DEBUG print( "ConfPostRequest::getValidatorInstance<br/>" );
        return parent::getValidatorInstance()->after(function($validator){
            // Call the after method of the FormRequest (see below)
            $this->after($validator);
        });
    }
    public function after($validator)
    {
        //DEBUG print( "ConfPostRequest::after<br/>" );

        // Un seul passeur
        $nb_pass = $this->input('nbpassG')
            + $this->input('nbpassC')
            + $this->input('nbpassD');
        if( $nb_pass > 1 ) {
            $validator->errors()->add('nbpass', 'On n\'a droit qu\'à un seul passeur');
        }

        // 10 players on the field
        $nb_players = $this->input('nbdefG')
            + $this->input('nbattG')
            + $this->input('nbquartG')
            + $this->input('nbdefC')
            + $this->input('nbattC')
            + $this->input('nbquartC')
            + $this->input('nbdefD')
            + $this->input('nbattD')
            + $this->input('nbquartD');
        $nb_players += $nb_pass;
        if( $nb_players != 10 ) {
            $validator->errors()->add('nbplayers', 'Il faut 10 joueurs dans l\'équipe');
        }
    }
}
