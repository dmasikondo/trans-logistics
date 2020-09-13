
{!!Form::label($countrylabel,$placeholder, $id)!!}
{!!Form::select($country,[
  'BOTSWANA'=>'BOTSWANA',
  'CONGO, THE DEMOCRATIC REPUBLIC OF THE'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
  'MALAWI'=>'MALAWI',
  'MOZAMBIQUE'=>'MOZAMBIQUE',
  'SOUTH AFRICA'=>'SOUTH AFRICA',
  'ZAMBIA'=>'ZAMBIA',
  'ZIMBABWE'=>'ZIMBABWE'], null, ['class'=>'form-control','placeholder'=>$placeholder,
  	'id'=>$id])!!}

