<?php

namespace App\Models;

use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    //Table name
    const TABLE_NAME = "problems";
    private $errors;

    protected $fillable = ['title', 'condition', 'answer', 'is_ready'];

    public function setIsReadyAttribute($value)
    {
        $this->attributes['is_ready'] = is_null($value) ? false : true;
    }

    //Validation rules for the table data
    private $validateRules = [
        'title' => 'min:2|max:191|unique:problems',
        'condition' => 'max:191',
        'answer' => 'max:191'
    ];

    public function validate (array $attributes)
    {
            $validator =  \Validator::make($attributes, $this->validateRules);
            if($validator->fails()){
                $this->errors = $validator->messages()->first();
                return false;
            }
            return true;

    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getProblems(Bool $is_admin)
    {
        $data = array(
            'ready' => $this->where('is_ready', '1')->get()
        );

        if($is_admin)
        {
            $data['not_ready'] = $this->where('is_ready', '0')->get();
        }

        return $data;
    }
    public function getProblem(int $id)
    {
        return $this->find($id);
    }

    public function createProblem(array $data)
    {
        $validator =  $this->validate($data);
            if(!$validator){
                return false;
            } else {

            $this->title = $data['title'];
            $this->condition = $data['condition'];
            $this->answer = $data['answer'];
            $this->is_ready = $data['is_ready'];
            $this->user_id = $data['user_id'];
            $this->save();

            return true;
        }
    }

    public function updateProblem(array $data, int $id):bool
    {
        $problem = $this->find($id);
        if($data['title']===$problem['title'])
        {
                $v = $this->validate(['condition' => $data['condition'], 'answer' => $data['answer']]);
        } else {
            $v = $this->validate($data);
        }
        if(!$v){
            return false;
        } else {

            foreach ($data as $key => $value){
                $problem->$key = $value;
            }
              $problem->save();
            return true;
        }
    }

    public function deleteProblem(int $id)
    {
        $problem = $this->find($id);
        $problem->delete();
    }
}