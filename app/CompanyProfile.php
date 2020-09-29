<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
	/**
	 * @var string Table	 
	 */

	protected $table = 'company_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profiledoc',
    ];

    protected $appends = ['file_type','created_date'];

    public function getCreatedDateAttribute(){
    	return $this->created_at->diffForHumans();
    }

    public function getFileTypeAttribute()
    {
    	//$profiledoc =$this->profiledoc;
    	//$ext = end(explode('.', $profiledoc));
		//$pi = pathinfo($this->profiledoc);
		//$txt = $pi['filename'];
		//$ext = $pi['extension'];    	
		$ext  = pathinfo($this->profiledoc, PATHINFO_EXTENSION);

        switch($ext)
        {
            case 'pdf':
            $type='fa fa-file-pdf-o text-danger';
            break;
            case 'doc':
            $type='fa fa-file-word-o text-info';
            break; 
            case 'docx':
            $type='fa fa-file-word-o text-info';
            break;   
            case 'xlsx':
            $type='fa fa-file-excel-o text-success';
            break;                                  
            default:
            $type='fa fa-file-image-o';                                                                                                                                            
        } 

        return $type;     	
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
