# Validation for PHP project

### How to use


#### 1、Install

```
composer require hsucy/validation dev-master
```

#### 2、Create Input Form

for example

```
use Hsucy\Validation\Validate;

class UserForm extends Validate
{
    // rule
    public function rules()
    {
        return [
            'age'   => ['integer', 'unsigned' => true, 'min' => 1, 'max' => 120],
        ];
    }

    // scenario
    public function scenarios()
    {
        return [
            'create' => ['required' => ['age']],
        ];
    }
    
    // message
    public function messages()
    {
        return [
            'age.integer'    => 'message',
            'age.unsigned'   => 'message',
            'age.min'        => 'message',
            'age.max'        => 'message',
        ];
    }
}
```

At first,you should create form class extend from the `Hsucy\Validation\Validate`,and set the **rules**,**scenarios** and **message**.The **rules** is userd for the validation of request data,and the **scenarios** decide the operation of rules.At last,the **message** return the error tips.

#### 3、Set up the attriubte to form

for example

I use the easyswoole framework

```
$model = new UserForm();
$model->attributes = $this->request()->getRequestParam();
$model->setScenario('create');
if (!$model->validate()) {
    $this->writeJson(402,  [],  $model->getErrors());
       return true;
}
$this->response()->write('this is controller test2 and your id is '.$this->request()->getRequestParam('age'));
```

create the new class **UserForm**,then set up the attribute and scenario.At last,use validate method to excute the validation

Thanks.







