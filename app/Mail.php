<?php

namespace App;

use Hashids\Hashids;
use App\Events\MailCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Mail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mails';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at ', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];

    /**
     * Encrypt email id.
     *
     * @return string
     */
    public function getHIdAttribute()
    {
        return (new Hashids(env('APP_KEY'), 15))->encode($this->id);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('analyze', function (Builder $builder) {
            $builder->join(
                'analyze_mails', 
                'mails.id', 
                '=',
                'analyze_mails.mail_id'
            );
        });
    }

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => MailCreated::class,
    ];
    
}
